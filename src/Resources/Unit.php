<?php

namespace ProductFlow\KauflandPhpClient\Resources;

use ProductFlow\KauflandPhpClient\Exceptions\KauflandException;

class Unit extends Model
{
    /**
     * @return array|string
     * @throws KauflandException
     */
    public function list()
    {
        return $this->connection->request('GET', 'units', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     * @throws KauflandException
     */
    public function show($identifier): array
    {
        return $this->connection->request('GET', "units/{$identifier}");
    }

    /**
     * @param array $attributes
     * @return array
     * @throws KauflandException
     */
    public function create(array $attributes): array
    {
        return $this->connection->request('POST', 'units', ['body' => $attributes, 'query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     * @throws KauflandException
     */
    public function update($identifier, array $attributes): array
    {
        return $this->connection->request('PATCH', "units/{$identifier}", ['body' => $attributes, 'query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     * @throws KauflandException
     */
    public function delete($identifier): array
    {
        return $this->connection->request('DELETE', "units/{$identifier}", ['query' => $this->getQuery()]);
    }
}
