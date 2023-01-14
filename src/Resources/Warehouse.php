<?php

namespace ProductFlow\KauflandPhpClient\Resources;

use GuzzleHttp\Exception\GuzzleException;
use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;

class Warehouse extends Model
{
    /**
     * @return array
     * @throws GuzzleException
     * @throws KauflandException
     */
    public function list(): array
    {
        return $this->connection->request('GET', 'warehouses/seller', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     * @throws GuzzleException
     * @throws KauflandException
     */
    public function show($identifier): array
    {
        return $this->connection->request('GET', "warehouses/{$identifier}");
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     * @throws GuzzleException
     * @throws KauflandException
     */
    public function create($identifier, array $attributes): array
    {
        return $this->connection->request('POST', "warehouses/{$identifier}", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     * @throws GuzzleException
     * @throws KauflandException
     */
    public function update($identifier, array $attributes): array
    {
        return $this->connection->request('PATCH', "warehouses/{$identifier}", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @return array
     * @throws GuzzleException
     * @throws KauflandException
     */
    public function delete($identifier): array
    {
        return $this->connection->request('DELETE', "warehouses/{$identifier}");
    }
}
