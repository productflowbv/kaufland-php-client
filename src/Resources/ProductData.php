<?php

namespace RemCom\KauflandPhpClient\Resources;

class ProductData extends Model
{
    /**
     * @param $ean
     * @return array
     */
    public function show($ean)
    {
        return $this->connection->request('GET', "items/{$ean}");
    }

    /**
     * @param $ean
     * @param array $attributes
     * @return array
     */
    public function create($ean, array $attributes): array
    {
        return $this->connection->request('PUT', "items/{$ean}", ['body' => $attributes]);
    }

    /**
     * @param $ean
     * @param array $attributes
     * @return array
     */
    public function update($ean, array $attributes): array
    {
        return $this->connection->request('PATCH', "items/{$ean}", ['body' => $attributes]);
    }

    /**
     * @param $ean
     * @return array
     */
    public function delete($ean): array
    {
        return $this->connection->request('DELETE', "items/{$ean}");
    }
}
