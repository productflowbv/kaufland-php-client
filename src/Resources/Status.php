<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Status extends Model
{
    /**
     * @return array
     */
    public function ping()
    {
        return $this->connection->request('GET', 'status/ping');
    }
}
