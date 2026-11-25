<?php

namespace ProductFlow\KauflandPhpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;
use ProductFlow\KauflandPhpClient\Exceptions\KauflandNoCredentialsException;
use Psr\Http\Message\ResponseInterface;

class Connection
{
    /**
     * @var string
     */
    protected $client_key;

    /**
     * @var string
     */
    protected $secret_key;

    /**
     * @var string
     */
    protected $user_agent;

    /**
     * Technology partner Client Key (optional)
     * @var ?string
     */
    protected $partner_client_key;

    /**
     * Technology partner Secret Key (optional)
     * @var ?string
     */
    protected $partner_secret_key;

    /**
     * @var string
     */
    protected $url = 'https://sellerapi.kaufland.com/v2/';

    /**
     * Contains the HTTP client (Guzzle)
     * @var ?Client
     */
    private $client;

    public function __construct(
        string $client_key,
        string $secret_key,
        string $user_agent,
        ?string $partner_client_key = null,
        ?string $partner_secret_key = null
    ) {
        if (! $client_key || ! $secret_key) {
            throw new KauflandNoCredentialsException('No client_key and/or secret_key is set');
        }

        if ((bool) $partner_client_key !== (bool) $partner_secret_key) {
            throw new KauflandNoCredentialsException('Both partner_client_key and partner_secret_key must be set when using partner credentials');
        }

        $this->client_key = $client_key;
        $this->secret_key = $secret_key;
        $this->user_agent = $user_agent;
        $this->partner_client_key = $partner_client_key ?: null;
        $this->partner_secret_key = $partner_secret_key ?: null;
    }

    public function hasPartnerCredentials(): bool
    {
        return $this->partner_client_key !== null && $this->partner_secret_key !== null;
    }

    private function signRequest($method, $uri, $body, $timestamp, $secret_key)
    {
        $string = implode("\n", [
            $method,
            $uri,
            $body,
            $timestamp,
        ]);

        return hash_hmac('sha256', $string, $secret_key);
    }

    public function getClient()
    {
        if (! $this->client) {
            $this->client = new Client([
                'base_uri' => $this->url,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Shop-Client-Key' => $this->client_key,
                    'User-Agent' => $this->user_agent,
                ],
            ]);
        }

        return $this->client;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array|string Array if the response was JSON, raw response body otherwise.
     * @throws KauflandException
     */
    public function request(string $method, string $uri, array $options = [])
    {
        try {
            $query = $body = '';
            $timestamp = time();

            if (! empty($options['query'])) {
                $query = '?'.http_build_query($options['query'], '', '&');
            }

            if (! empty($options['body'])) {
                $body = json_encode($options['body']);
                $options['body'] = json_encode($options['body']);
            }

            $header = [
                'Shop-Timestamp' => $timestamp,
                'Shop-Signature' => $this->signRequest(
                    $method,
                    $this->url.$uri.$query,
                    $body,
                    $timestamp,
                    $this->secret_key
                ),
            ];

            if ($this->hasPartnerCredentials()) {
                $header['Shop-Partner-Client-Key'] = $this->partner_client_key;
                $header['Shop-Partner-Signature'] = $this->signRequest(
                    $method,
                    $this->url.$uri.$query,
                    $body,
                    $timestamp,
                    $this->partner_secret_key
                );
            }

            $options['headers'] = $header;

            $response = $this->getClient()->request($method, $uri, $options);

            return $this->parseResponse($response);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $this->parseResponse($e->getResponse());
            }

            throw new KauflandException(
                'Kaufland error: '.$e->getResponse()->getBody(),
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
            throw new KauflandException('Kaufland error: '.$e->getMessage());
        }
    }
}
