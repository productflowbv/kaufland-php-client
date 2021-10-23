<?php

namespace RemCom\KauflandPhpClient\Resources;

class ShippingGroup extends Model
{
    public function list()
    {
        return $this->connection->request('GET', 'shipping-groups/', ['query' => $this->getQuery()]);
    }
}
