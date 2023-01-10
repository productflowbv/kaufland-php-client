<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Returns extends Model
{
    /**
     * @param array $status
     * @return mixed
     */
    public function list(array $status = [])
    {
        return $this->connection->request('GET', 'returns/seller/', ['query' => $this->getQuery() + array_filter(['status' => implode(',', $status)])]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier)
    {
        return $this->connection->request('GET', "returns/{$identifier}");
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function create(array $attributes): array
    {
        return $this->connection->request('POST', "returns", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     */
    public function update($identifier, array $attributes): array
    {
        return $this->connection->request('POST', "returns/{$identifier}", ['body' => $attributes]);
    }
}
