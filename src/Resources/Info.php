<?php

namespace ProductFlow\KauflandPhpClient\Resources;

use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;

class Info extends Model
{
    /**
     * @return array
     * @throws KauflandException
     */
    public function list(): array
    {
        return $this->connection->request('GET', 'info/vat-indicators', ['query' => $this->getQuery()]);
    }
}