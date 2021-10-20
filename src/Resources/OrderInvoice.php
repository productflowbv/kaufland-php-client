<?php

namespace RemCom\KauflandPhpClient\Resources;

class OrderInvoice extends Model
{
    public function list()
    {
        return $this->connection->request('GET', 'order-invoices/seller/', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier): array
    {
        return $this->connection->request('GET', "order-invoices/{$identifier}");
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function create(array $attributes): array
    {
        return $this->connection->request('POST', "order-invoices/", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function delete($identifier): array
    {
        return $this->connection->request('DELETE', "order-invoices/{$identifier}");
    }
}