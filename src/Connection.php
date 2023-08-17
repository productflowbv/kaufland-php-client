<?php

namespace ProductFlow\KauflandPhpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use ProductFlow\KauflandPhpClient\Options\Locale;
use ProductFlow\KauflandPhpClient\Options\Storefront;
use Psr\Http\Message\ResponseInterface;
use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;
use ProductFlow\KauflandPhpClient\Exceptions\KauflandNoCredentialsException;

class Connection
{
    protected string $client_key;

    protected string $secret_key;

    protected string $user_agent;

    protected string $url = 'https://sellerapi.kaufland.com/v2/';

    protected Locale $locale;

    protected Storefront $storefront;

    /**
     * Contains the HTTP client (Guzzle)
     * @var Client
     */
    private Client $client;

    /**
     * @throws KauflandNoCredentialsException
     */
    public function __construct(
        string $client_key,
        string $secret_key,
        string $user_agent,
        Locale $locale = null,
        Storefront $storefront = null
    ) {
        if (! $client_key || ! $secret_key) {
            throw new KauflandNoCredentialsException('No client_key and/or secret_key is set');
        }

        if (!isset($locale)) {
            $locale = new Locale();
        }
        if (!isset($storefront)) {
            $storefront = new Storefront();
        }

        $this->client_key = $client_key;
        $this->secret_key = $secret_key;
        $this->user_agent = $user_agent;
        $this->locale = $locale;
        $this->storefront = $storefront;
    }

    private function signRequest($method, $uri, $body, $timestamp, $secret_key): string
    {
        $string = implode("\n", [
            $method,
            $uri,
            $body,
            $timestamp,
        ]);

        return hash_hmac('sha256', $string, $secret_key);
    }

    public function getClient(): Client
    {
        $this->client = new Client([
            'base_uri' => $this->url,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Shop-Client-Key' => $this->client_key,
                'User-Agent' => $this->user_agent
            ]
        ]);

        return $this->client;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     * @throws KauflandException|GuzzleException
     */
    public function request(string $method, string $uri, array $options = []): array
    {
        try {
            $body = '';
            $timestamp = time();

            $options['query'] = $options['query'] ?? [];

            $options['query'] = array_merge(
                [
                    Storefront::getQueryParameterName() => (string)$this->storefront,
                    Locale::getQueryParameterName() => (string)$this->locale,
                ],
                $options['query']
            );

            $query = '?' . http_build_query($options['query'], '', '&');

            if (! empty($options['body'])) {
                $body = json_encode($options['body']);
                $options['body'] = json_encode($options['body']);
            }

            $header = [
                'Shop-Timestamp' => $timestamp,
                'Shop-Signature' => $this->signRequest(
                    $method,
                    $this->url . $uri . $query,
                    $body,
                    $timestamp,
                    $this->secret_key
                ),
                Locale::getQueryParameterName()    => (string)$this->locale
            ];

            $options['headers'] = $header;

            $response = $this->getClient()->request($method, $uri, $options);

            return $this->parseResponse($response);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $this->parseResponse($e->getResponse());
            }

            throw new KauflandException(
                'Kaufland error: ' . $e->getResponse()->getBody(),
                $e->getResponse()->getStatusCode()
            );
        }
    }

    /**
     * @param ResponseInterface $response
     * @return array Parsed JSON result
     * @throws KauflandException
     */
    private function parseResponse(ResponseInterface $response): array
    {
        try {
            // Rewind the response (middlewares might have read it already)
            $response->getBody()->rewind();

            $response_body = $response->getBody()->getContents();
            $result_array = json_decode($response_body, true);

            if ($response->getStatusCode() === 204) {
                return [];
            }

            if (! is_array($result_array)) {
                throw new KauflandException(sprintf('Kaufland error %s: %s', $response->getStatusCode(), $response_body), $response->getStatusCode());
            }

            return $result_array;
        } catch (\RuntimeException $e) {
            throw new KauflandException('Kaufland error: ' . $e->getMessage());
        }
    }
}
