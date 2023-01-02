<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Category extends Model
{
    /**
     * @return array
     */
    public function tree()
    {
        return $this->connection->request('GET', 'categories/tree', ['query' => $this->getQuery()]);
    }

    /**
     * @return array
     */
    public function list()
    {
        return $this->connection->request('GET', 'categories/', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @param array $embedded
     * @return array
     */
    public function show($identifier, array $embedded = null)
    {
        return $this->connection->request('GET', "categories/{$identifier}", ['query' => array_filter($this->getQuery() + ['embedded' => $embedded])]);
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
