<?php

namespace RemCom\KauflandPhpClient\Resources;

class Order extends Model
{
    public function list()
    {
        return $this->connection->request('GET', 'orders/seller/', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier)
    {
        return $this->connection->request('GET', "orders/{$identifier}");
    }
}
