<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Shipment extends Model
{
    /**
     * Add a shipment to an order unit which is already marked as sent.
     * @param array $attributes 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function create(array $attributes): array
    {
        if (empty($attributes['id_order_unit'])) {
            throw new InvalidArgumentException("Parameter 'id_order_unit' is required.");
        }

        if (empty($attributes['shipment_information'])) {
            throw new InvalidArgumentException("Parameter 'shipment_information' is required.");
        }

        if (empty($attributes['shipment_information']['carrier_code'])) {
            throw new InvalidArgumentException("Parameter 'shipment_information.carrier_code' is required.");
        }

        if (empty($attributes['shipment_information']['tracking_number'])) {
            throw new InvalidArgumentException("Parameter 'shipment_information.tracking_number' is required.");
        }

        return $this->connection->request('POST', "shipments", [
            'body' => $attributes,
        ]);
    }

}
