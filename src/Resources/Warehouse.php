<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Warehouse extends Model
{
    /**
     * @return mixed
     */
    public function list()
    {
        return $this->connection->request('GET', 'warehouses/seller', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier): array
    {
        return $this->connection->request('GET', "warehouses/{$identifier}");
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     */
    public function create($identifier, array $attributes): array
    {
        return $this->connection->request('POST', "warehouses/{$identifier}", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     */
    public function update($identifier, array $attributes): array
    {
        return $this->connection->request('PATCH', "warehouses/{$identifier}", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function delete($identifier): array
    {
        return $this->connection->request('DELETE', "warehouses/{$identifier}");
    }
}
