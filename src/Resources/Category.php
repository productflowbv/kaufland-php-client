<?php

namespace RemCom\KauflandPhpClient\Resources;

class Category extends Model
{
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
    public function show($identifier, $embedded = [])
    {
        return $this->connection->request('GET', "categories/{$identifier}", [array_filter(['embedded' => implode(',', $embedded)])]);
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
