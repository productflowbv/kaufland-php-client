<?php 

namespace ProductFlow\KauflandPhpClient\Resources;

class Carrier extends Model 
{

    /**
     * Get a list of carriers.
     * @return array|string
     */
    public function list()
    {
        return $this->connection->request('GET', 'carriers', ['query' => $this->getQuery()]);
    }
}