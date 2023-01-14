<?php

namespace ProductFlow\KauflandPhpClient\Resources;

use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;

class Attribute extends Model
{
    /**
     * @throws KauflandException
     */
    public function list()
    {
        return $this->connection->request('GET', 'attributes', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     * @throws KauflandException
     */
    public function show($identifier)
    {
        return $this->connection->request('GET', "attributes/{$identifier}");
    }
}
