<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class ShippingGroup extends Model
{
    /**
     * @return mixed
     */
    public function list()
    {
        return $this->connection->request('GET', 'shipping-groups', ['query' => $this->getQuery()]);
    }
}
