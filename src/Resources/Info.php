<?php

namespace ProductFlow\KauflandPhpClient\Resources;

use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;

class Info extends Model
{
    /**
     * @return array
     * @throws KauflandException
     */
    public function vatIndicators()
    {
        return $this->connection->request('GET', 'info/vat-indicators', ['query' => $this->getQuery()]);
    }

    public function locale()
    {
        return $this->connection->request('GET', 'info/locale', ['query' => $this->getQuery()]);
    }

    public function storeFront()
    {
        return $this->connection->request('GET', 'info/store-front', ['query' => $this->getQuery()]);
    }
}
