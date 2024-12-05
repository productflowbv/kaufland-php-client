<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class ShippingLabel extends Model
{
    /**
     * Request and create a shipping label.
     * @param array $attributes 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function create(array $attributes): array
    {
        if (empty($attributes['ids_order_units']) || !is_array($attributes['ids_order_units'])) {
            throw new InvalidArgumentException("Parameter 'ids_order_units' is required and must be an array.");
        }

        if (empty($attributes['carriers']) || !is_array($attributes['carriers'])) {
            throw new InvalidArgumentException("Parameter 'carriers' is required and must be an array.");
        }

        if (empty($attributes['package_measurements']) || !is_array($attributes['package_measurements'])) {
            throw new InvalidArgumentException("Parameter 'package_measurements' is required and must be an array.");
        }

        return $this->connection->request('POST', 'shipping-labels', [
            'body' => $attributes,
        ]);
    }

}