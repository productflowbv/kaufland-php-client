<?php

namespace RemCom\KauflandPhpClient\Resources;

class Subscription extends Model
{
    /**
     * @return mixed
     */
    public function list()
    {
        return $this->connection->request('GET', 'subscriptions/seller/', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier): array
    {
        return $this->connection->request('GET', "subscriptions/{$identifier}");
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     */
    public function create($identifier, array $attributes): array
    {
        return $this->connection->request('POST', "subscriptions/{$identifier}", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     */
    public function update($identifier, array $attributes): array
    {
        return $this->connection->request('PATCH', "subscriptions/{$identifier}", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function delete($identifier): array
    {
        return $this->connection->request('DELETE', "subscriptions/{$identifier}");
    }
}
