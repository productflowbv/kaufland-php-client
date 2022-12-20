<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Attribute extends Model
{
    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier)
    {
        return $this->connection->request('GET', "attributes/{$identifier}");
    }
}
