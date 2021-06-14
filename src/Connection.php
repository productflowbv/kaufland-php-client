<?php

namespace RemCom\KauflandPhpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
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

    function signRequest($method, $uri, $body, $timestamp, $secretKey)
    {
        $string = implode("\n", [
            $method,
            $uri,
            $body,
            $timestamp,
        ]);

        return hash_hmac('sha256', $string, $secretKey);
    }

    private function handleAuthorizationHeader(): \Closure
    {
        return function (callable $handler)
        {
            return function (RequestInterface $request, array $options) use ($handler)
            {
                $timestamp = time();

//                $request = $request->withHeader('Hm-Timestamp', $timestamp);
//                $request = $request->withHeader('Hm-Signature', $this->signRequest('GET', 'https://www.kaufland.de/api/v1/orders/seller/', '', $timestamp, $this->secret_key));

                return $handler($request, $options);
            };
        };
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

        $handlerStack->push($this->handleAuthorizationHeader());

        $time = time();
        $clientConfig = [
            'base_uri' => $this->url,
            'handler' => $handlerStack,
            'headers'  => [
                'Accept' => 'application/json',
//                'Content-Type' => 'application/json',
                'Hm-Client' => $this->client_key,
                'Hm-Timestamp' => $time,
                'Hm-Signature' => $this->signRequest('GET', 'https://www.kaufland.de/api/v1/orders/seller/', '', $time, $this->secret_key)
            ]
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
            print_r($e->getRequest());
//            die();
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
