<?php

namespace RemCom\KauflandPhpClient\Resources;

class Category extends Model
{
    public function list()
    {
        return $this->connection->request('GET', 'categories/', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier)
    {
        return $this->connection->request('GET', "categories/{$identifier}");
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function decide(array $attributes): array
    {
        return $this->connection->request('POST', "categories/decide/", ['body' => $attributes]);
    }
}
