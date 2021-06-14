<?php

namespace RemCom\KauflandPhpClient;

/**
 * Class Kaufland
 * @package RemCom\KauflandPhpClient
 */
class Kaufland
{

    /**
     * @var
     */
    protected $client_key;

    /**
     * @var
     */
    protected $secret_key;

    /**
     * @var
     */
    protected $connection;


    /**
     * @param string $client_key
     */
    public function setClientKey(string $client_key): void
    {
        $this->client_key = $client_key;
    }

    /**
     * @param string $secret_key
     */
    public function setSecretKey(string $secret_key): void
    {
        $this->secret_key = $secret_key;
    }

    /**
     * @return Connection
     * @throws Exceptions\KauflandNoCredentialsException
     */
    private function getConnection(): Connection
    {
        if ($this->connection == null) {
            $this->connection = new Connection($this->client_key, $this->secret_key);
        }
        return $this->connection;
    }
}
