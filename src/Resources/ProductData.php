<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class ProductData extends Model
{
    /**
     * @param $ean
     * @return array
     */
    public function show($ean)
    {
        return $this->connection->request('GET', "product-data/{$ean}");
    }

    /**
     * @param $ean
     * @param array $attributes
     * @return array
     */
    public function create($ean, array $attributes): array
    {
        return $this->connection->request('PUT', "product-data/{$ean}", ['body' => $attributes]);
    }

    /**
     * @param $ean
     * @param array $attributes
     * @return array
     */
    public function update(array $attributes): array
    {
        return $this->connection->request('PATCH', 'product-data', ['body' => $attributes]);
    }

    /**
     * @param $ean
     * @return array
     */
    public function delete($ean): array
    {
        return $this->connection->request('DELETE', "product-data/{$ean}");
    }

    /**
     * @param $ean
     * @return array
     */
    public function status($ean)
    {
        return $this->connection->request('GET', "product-data/status/{$ean}", ['query' => $this->getQuery()]);
    }
}
