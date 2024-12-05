<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Warehouse extends Model
{
    /**
     * Get a list of warehouses.
     * @param array $queryParams
     * @return array
     * @throws \InvalidArgumentException
     */
    public function list(array $queryParams = []): array
    {
        return $this->connection->request('GET', 'warehouses', [
            'query' => array_filter($queryParams),
        ]);
    }

    /**
     * Get a warehouse by ID.
     * @param string|int $idWarehouse 
     * @return array
     * @throws \InvalidArgumentException
     */
    public function show($idWarehouse): array
    {
        if (empty($idWarehouse)) {
            throw new InvalidArgumentException("Parameter 'id_warehouse' is required.");
        }

        return $this->connection->request('GET', "warehouses/{$idWarehouse}");
    }

    /**
     * Create a new warehouse.
     * @param array $attributes 
     * @return array
     * @throws \InvalidArgumentException
     */
    public function create(array $attributes): array
    {
        if (empty($attributes['name'])) {
            throw new InvalidArgumentException("Parameter 'name' is required.");
        }

        if (empty($attributes['address']) || !is_array($attributes['address'])) {
            throw new InvalidArgumentException("Parameter 'address' is required and must be an array.");
        }

        $requiredAddressFields = ['street', 'city', 'house_number', 'postcode', 'country'];
        foreach ($requiredAddressFields as $field) {
            if (empty($attributes['address'][$field])) {
                throw new InvalidArgumentException("Field 'address.{$field}' is required.");
            }
        }

        if (!isset($attributes['is_default'])) {
            throw new InvalidArgumentException("Parameter 'is_default' is required.");
        }

        return $this->connection->request('POST', "warehouses", [
            'body' => $attributes,
        ]);
    }

    /**
     * Update a warehouse by ID.
     * @param string|int $idWarehouse
     * @param array $attributes
     * @return array
     * @throws \InvalidArgumentException
     */
    public function update($idWarehouse, array $attributes): array
    {
        if (empty($idWarehouse)) {
            throw new InvalidArgumentException("Parameter 'id_warehouse' is required.");
        }

        if (empty($attributes['name'])) {
            throw new InvalidArgumentException("Parameter 'name' is required.");
        }

        if (empty($attributes['address']) || !is_array($attributes['address'])) {
            throw new InvalidArgumentException("Parameter 'address' is required and must be an array.");
        }

        $requiredAddressFields = ['street', 'city', 'house_number', 'postcode', 'country'];
        foreach ($requiredAddressFields as $field) {
            if (empty($attributes['address'][$field])) {
                throw new InvalidArgumentException("Field 'address.{$field}' is required.");
            }
        }

        if (!isset($attributes['is_default'])) {
            throw new InvalidArgumentException("Parameter 'is_default' is required.");
        }

        return $this->connection->request('PUT', "warehouses/{$idWarehouse}", [
            'body' => $attributes,
        ]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function delete($identifier): array
    {
        return $this->connection->request('DELETE', "warehouses/{$identifier}");
    }
}
