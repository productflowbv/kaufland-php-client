<?php

namespace ProductFlow\KauflandPhpClient;

use ProductFlow\KauflandPhpClient\Resources\Attribute;
use ProductFlow\KauflandPhpClient\Resources\Category;
use ProductFlow\KauflandPhpClient\Resources\ImportFile;
use ProductFlow\KauflandPhpClient\Resources\Info;
use ProductFlow\KauflandPhpClient\Resources\Item;
use ProductFlow\KauflandPhpClient\Resources\Order;
use ProductFlow\KauflandPhpClient\Resources\OrderInvoice;
use ProductFlow\KauflandPhpClient\Resources\OrderUnit;
use ProductFlow\KauflandPhpClient\Resources\ProductData;
use ProductFlow\KauflandPhpClient\Resources\Report;
use ProductFlow\KauflandPhpClient\Resources\Returns;
use ProductFlow\KauflandPhpClient\Resources\ReturnUnit;
use ProductFlow\KauflandPhpClient\Resources\Shipment;
use ProductFlow\KauflandPhpClient\Resources\ShippingGroup;
use ProductFlow\KauflandPhpClient\Resources\Status;
use ProductFlow\KauflandPhpClient\Resources\Subscription;
use ProductFlow\KauflandPhpClient\Resources\Ticket;
use ProductFlow\KauflandPhpClient\Resources\TicketMessage;
use ProductFlow\KauflandPhpClient\Resources\Unit;
use ProductFlow\KauflandPhpClient\Resources\Warehouse;

/**
 * Class Kaufland
 * @package ProductFlow\KauflandPhpClient
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

    protected string $user_agent = 'Kaufland-php-client/V1';

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @param string $client_key
     */
    public function setClientKey(string $client_key): static
    {
        $this->client_key = $client_key;

        return $this;
    }

    /**
     * @param string $secret_key
     */
    public function setSecretKey(string $secret_key): static
    {
        $this->secret_key = $secret_key;

        return $this;
    }

    /**
     * @param string $user_agent
     */
    public function setUserAgent(string $user_agent): static
    {
        $this->user_agent = $user_agent;

        return $this;
    }

    /**
     * @return Connection
     * @throws Exceptions\KauflandNoCredentialsException
     */
    private function getConnection(): Connection
    {
        if ($this->connection == null) {
            $this->connection = new Connection($this->client_key, $this->secret_key, $this->user_agent);
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

    /**
     * @return Info
     * @throws Exceptions\KauflandNoCredentialsException
     */
    public function info(): Info
    {
        return new Info($this->getConnection());
    }
}
