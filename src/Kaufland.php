<?php

namespace RemCom\KauflandPhpClient;

use RemCom\KauflandPhpClient\Resources\Attribute;
use RemCom\KauflandPhpClient\Resources\Category;
use RemCom\KauflandPhpClient\Resources\Order;
use RemCom\KauflandPhpClient\Resources\OrderInvoice;
use RemCom\KauflandPhpClient\Resources\OrderUnit;
use RemCom\KauflandPhpClient\Resources\Returns;
use RemCom\KauflandPhpClient\Resources\ReturnUnit;
use RemCom\KauflandPhpClient\Resources\Shipment;

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
     * @return Attribute
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function attribute()
    {
        return new Attribute($this->getConnection());
    }

    /**
     * @return Category
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function Category()
    {
        return new Category($this->getConnection());
    }

    /**
     * @return Order
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function order()
    {
        return new Order($this->getConnection());
    }

    /**
     * @return OrderUnit
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function orderUnit()
    {
        return new OrderUnit($this->getConnection());
    }

    /**
     * @return OrderInvoice
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function orderInvoice()
    {
        return new OrderInvoice($this->getConnection());
    }

    /**
     * @return Shipment
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function shipment()
    {
        return new Shipment($this->getConnection());
    }

    /**
     * @return Returns
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function returns()
    {
        return new Returns($this->getConnection());
    }

    /**
     * @return ReturnUnit
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function returnUnit()
    {
        return new ReturnUnit($this->getConnection());
    }
}
