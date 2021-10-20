<?php

namespace RemCom\KauflandPhpClient;

use RemCom\KauflandPhpClient\Resources\Order;
use RemCom\KauflandPhpClient\Resources\OrderUnit;

/**
 * Class Kaufland
 * @package RemCom\KauflandPhpClient
 */
class Kaufland
{

    /**
     * @var string
     */
    protected string $client_key;

    /**
     * @var string
     */
    protected string $secret_key;

    /**
     * @var Connection
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

    /**
     * @return Order
     */
    public function order()
    {
        return new Order($this->getConnection());
    }

    /**
     * @return OrderUnit
     */
    public function orderUnit()
    {
        return new OrderUnit($this->getConnection());
    }
}
