<?php

namespace RemCom\KauflandPhpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\ResponseInterface;
use RemCom\KauflandPhpClient\Exceptions\KauflandException;
use RemCom\KauflandPhpClient\Exceptions\KauflandNoCredentialsException;

class Connection
{

    protected $client_key;

    protected $secret_key;

    protected $url = 'https://www.kaufland.de/api/v1';

    /**
     * Contains the HTTP client (Guzzle)
     * @var Client
     */
    private $client;

    /**
     * Array of inserted middleWares
     * @var array
     */
    protected $middleWares = [];

    public function __construct(string $client_key, string $secret_key)
    {
        if (!$client_key && !$secret_key) {
            throw new KauflandNoCredentialsException('No client_key and/or secret_key is set');
        }

        $this->client_key = $client_key;
        $this->secret_key = $secret_key;
    }

    public function client(): Client
    {
        if ($this->client) {
            return $this->client;
        }

        $handlerStack = HandlerStack::create();
        foreach ($this->middleWares as $middleWare) {
            $handlerStack->push($middleWare);
        }

        $clientConfig = [
            'base_uri' => $this->url,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'auth' => [
                $this->username,
                $this->password
            ],
            'handler' => $handlerStack
        ];

        $this->client = new Client($clientConfig);

        return $this->client;
    }

    /**
     * Perform a GET request
     * @param string $url
     * @param array $params
     * @return array
     * @throws KauflandException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($url, $params = []): array
    {
        try {
            $result = $this->client()->get($url, ['query' => $params]);

            return $this->parseResponse($result);
        } catch (RequestException $e) {
            $responseBody = $e->getResponse()->getBody()->getContents();
            throw new KauflandException(sprintf('Kaufland error %s: %s', $e->getResponse()->getStatusCode(), $responseBody), $e->getResponse()->getStatusCode());
        }
    }

    /**
     * Perform a POST request
     * @param string $url
     * @param mixed $body
     * @return array
     * @throws KauflandException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($url, $body): array
    {
        try {
            $result = $this->client()->post($url, ['body' => $body]);

            return $this->parseResponse($result);
        } catch (RequestException $e) {
            $responseBody = $e->getResponse()->getBody()->getContents();
            throw new KauflandException(sprintf('Kaufland error %s: %s', $e->getResponse()->getStatusCode(), $responseBody), $e->getResponse()->getStatusCode());
        }
    }

    /**
     * Perform PUT request
     * @param string $url
     * @param mixed $body
     * @return array
     * @throws KauflandException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($url, $body, $id): array
    {
        try {
            $result = $this->client()->put($url, ['body' => $body]);
            $this->parseResponse($result);
            
            return $this->parseResponse($result);
        } catch (RequestException $e) {
            $responseBody = $e->getResponse()->getBody()->getContents();
            throw new KauflandException(sprintf('Kaufland error %s: %s', $e->getResponse()->getStatusCode(), $responseBody), $e->getResponse()->getStatusCode());
        }
    }

    /**
     * Perform DELETE request
     * @param string $url
     * @return array
     * @throws KauflandException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($url)
    {
        try {
            $result = $this->client()->delete($url);
            return $this->parseResponse($result);
        } catch (RequestException $e) {
            $responseBody = $e->getResponse()->getBody()->getContents();
            throw new KauflandException(sprintf('Kaufland error %s: %s', $e->getResponse()->getStatusCode(), $responseBody), $e->getResponse()->getStatusCode());
        }
    }

    /**
     * @param ResponseInterface $response
     * @return array Parsed JSON result
     * @throws KauflandException
     */
    public function parseResponse(ResponseInterface $response)
    {
        // Rewind the response (middlewares might have read it already)
        $response->getBody()->rewind();

        $responseBody = $response->getBody()->getContents();
        $resultArray = json_decode($responseBody, true);

        return $resultArray;
    }
}
