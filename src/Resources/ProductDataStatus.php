<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class ProductDataStatus extends Model
{
    /**
     * @param $ean
     * @return array
     */
    public function show($ean)
    {
        return $this->connection->request('GET', "product-data-status/{$ean}");
    }
}
