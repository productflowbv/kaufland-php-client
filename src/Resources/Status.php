<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Status extends Model
{
    /**
     * Ping the Marketplace Seller API by Kaufland.
     * @return array|string 
     */
    public function ping(): array
    {
        return $this->connection->request('GET', "status/ping");
    }
}
