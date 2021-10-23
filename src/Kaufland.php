<?php

namespace RemCom\KauflandPhpClient;

use RemCom\KauflandPhpClient\Resources\Attribute;
use RemCom\KauflandPhpClient\Resources\Category;
use RemCom\KauflandPhpClient\Resources\ImportFile;
use RemCom\KauflandPhpClient\Resources\Item;
use RemCom\KauflandPhpClient\Resources\Order;
use RemCom\KauflandPhpClient\Resources\OrderInvoice;
use RemCom\KauflandPhpClient\Resources\OrderUnit;
use RemCom\KauflandPhpClient\Resources\ProductData;
use RemCom\KauflandPhpClient\Resources\ProductDataStatus;
use RemCom\KauflandPhpClient\Resources\Report;
use RemCom\KauflandPhpClient\Resources\Returns;
use RemCom\KauflandPhpClient\Resources\ReturnUnit;
use RemCom\KauflandPhpClient\Resources\Shipment;
use RemCom\KauflandPhpClient\Resources\ShippingGroup;
use RemCom\KauflandPhpClient\Resources\Status;
use RemCom\KauflandPhpClient\Resources\Subscription;
use RemCom\KauflandPhpClient\Resources\Ticket;
use RemCom\KauflandPhpClient\Resources\TicketMessage;
use RemCom\KauflandPhpClient\Resources\Unit;
use RemCom\KauflandPhpClient\Resources\Warehouse;

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
    public function category()
    {
        return new Category($this->getConnection());
    }

    /**
     * @return ImportFile
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function importFile()
    {
        return new ImportFile($this->getConnection());
    }

    /**
     * @return Item
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function item()
    {
        return new Item($this->getConnection());
    }

    /**
     * @return ProductData
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function productData()
    {
        return new ProductData($this->getConnection());
    }

    /**
     * @return ProductDataStatus
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function productDataStatus()
    {
        return new ProductDataStatus($this->getConnection());
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

    /**
     * @return Status
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function status()
    {
        return new Status($this->getConnection());
    }

    /**
     * @return Report
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function report()
    {
        return new Report($this->getConnection());
    }

    /**
     * @return ShippingGroup
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function shippingGroup()
    {
        return new ShippingGroup($this->getConnection());
    }

    /**
     * @return Unit
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function unit()
    {
        return new Unit($this->getConnection());
    }

    /**
     * @return Warehouse
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function warehouse()
    {
        return new Warehouse($this->getConnection());
    }

    /**
     * @return Subscription
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function subscription()
    {
        return new Subscription($this->getConnection());
    }

    /**
     * @return TicketMessage
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function ticketMessage()
    {
        return new TicketMessage($this->getConnection());
    }

    /**
     * @return Ticket
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function ticket()
    {
        return new Ticket($this->getConnection());
    }
}
