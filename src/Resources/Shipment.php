<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Shipment extends Model
{
    /**
     * @param array $attributes
     * @return array
     */
    public function create(array $attributes): array
    {
        return $this->connection->request('POST', "shipments/", ['body' => $attributes]);
    }
}
