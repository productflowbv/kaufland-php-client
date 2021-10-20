<?php

namespace RemCom\KauflandPhpClient;

use GuzzleHttp\Client;
use RemCom\KauflandPhpClient\Exceptions\KauflandException;
use RemCom\KauflandPhpClient\Exceptions\KauflandNoCredentialsException;

class Connection
{

    protected $client_key;

    protected $secret_key;

    protected $url = 'https://www.kaufland.de/api/v1/';

    /**
     * Contains the HTTP client (Guzzle)
     * @var Client
     */
    private $client;

    public function __construct(string $client_key, string $secret_key)
    {
        if (!$client_key && !$secret_key) {
            throw new KauflandNoCredentialsException('No client_key and/or secret_key is set');
        }

        $this->client_key = $client_key;
        $this->secret_key = $secret_key;
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
     */
    public function request(string $method, string $uri, array $options = [])
    {
        $query = '';
        if (isset($options['query'])) {
            if (count($options['query'])) {
                $query = '?' . http_build_query($options['query'], null, '&');
            }
        }

        $timestamp = time();
        $header = [
            'Hm-Client' => $this->client_key,
            'Hm-Timestamp' => $timestamp,
            'Hm-Signature' => $this->signRequest($method, $this->url . $uri . $query, '', $timestamp, $this->secret_key),
        ];

        $options['headers'] = $header;

        $response = $this->getClient()->request($method, $uri, $options);

        $contents = $response->getBody()->getContents();

        // fallback to application/json as this is, apart from 1 call, the return type
        $default = 'application/json';
        if (($response->getHeader('Content-Type')[0] ?? $default) === 'application/json') {
            $array = json_decode($contents, true);

            return (array)$array;
        } else {
            return $contents;
        }
    }
}
