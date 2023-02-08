<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class OrderInvoice extends Model
{
    /**
     * @return mixed
     */
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
     * @param $identifier
     * @param array $attributes
     * @return array
     */
    public function create($identifier, array $attributes): array
    {
        return $this->connection->request('POST', "order-invoices/{$identifier}", ['body' => $attributes]);
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
