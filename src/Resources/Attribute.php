<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Attribute extends Model
{
    public function list()
    {
        return $this->connection->request('GET', 'attributes', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier)
    {
        return $this->connection->request('GET', "attributes/{$identifier}");
    }
}
