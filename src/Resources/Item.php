<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Item extends Model
{
    /**
     * @param string $ean
     * @param string $q
     * @return mixed
     */
    public function list(string $ean = '', string $q = '')
    {
        return $this->connection->request('GET', 'items/', ['query' => $this->getQuery() + array_filter(['ean' => $ean, 'q' => $q])]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier)
    {
        return $this->connection->request('GET', "items/{$identifier}");
    }
}
