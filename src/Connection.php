<?php

namespace RemCom\KauflandPhpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use RemCom\KauflandPhpClient\Exceptions\KauflandException;
use RemCom\KauflandPhpClient\Exceptions\KauflandNoCredentialsException;

class Connection
{

    protected $client_key;

    protected $secret_key;

    protected $user_agent;

    protected $url = 'https://www.kaufland.de/api/v1/';

    /**
     * Contains the HTTP client (Guzzle)
     * @var Client
     */
    private $client;

    public function __construct(string $client_key, string $secret_key, string $user_agent)
    {
        if (!$client_key && !$secret_key) {
            throw new KauflandNoCredentialsException('No client_key and/or secret_key is set');
        }

        $this->client_key = $client_key;
        $this->secret_key = $secret_key;
        $this->user_agent = $user_agent;
    }

    private function signRequest($method, $uri, $body, $timestamp, $secretKey)
    {
        $string = implode("\n", [
            $method,
            $uri,
            $body,
            $timestamp,
        ]);

        return hash_hmac('sha256', $string, $secretKey);
    }

    public function getClient()
    {
        if ($this->client) {
            return $this->client;
        }

        $clientConfig = [
            'base_uri' => $this->url,
            'headers' => [
                'Accept' => 'application/json',
                'Hm-Client' => $this->client_key,
                'User-Agent' => $this->user_agent
            ]
        ];

        $this->client = new Client($clientConfig);

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
            $query = '';
            if (isset($options['query'])) {
                if (count($options['query'])) {
                    $query = '?' . http_build_query($options['query'], null, '&');
                }
            }

            $body = '';
            if (isset($options['body'])) {
                $body = json_encode($options['body']);
            }

            $timestamp = time();
            $header = [
                'Hm-Client' => $this->client_key,
                'Hm-Timestamp' => $timestamp,
                'Hm-Signature' => $this->signRequest($method, $this->url . $uri . $query, $body, $timestamp, $this->secret_key)
            ];

            $options['headers'] = $header;

            $response = $this->getClient()->request($method, $uri, $options);

            return $this->parseResponse($response);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $this->parseResponse($e->getResponse());
            }

            throw new KauflandException('Kaufland error: (no error message provided)' . $e->getResponse(), $e->getResponse()->getStatusCode());
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

            if (!is_array($result_array)) {
                throw new KauflandException(sprintf('Kaufland error %s: %s', $response->getStatusCode(), $response_body), $response->getStatusCode());
            }

            return $result_array;
        } catch (\RuntimeException $e) {
            throw new KauflandException('Kaufland error: ' . $e->getMessage());
        }
    }
}
