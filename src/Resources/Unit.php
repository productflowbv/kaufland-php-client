<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Unit extends Model
{
    /**
     * Get a list of your units with required storefront and optional filters.
     * @param array $queryParams 
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function list(array $queryParams = [])
    {
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $query = $this->getQuery() + $queryParams;

        return $this->connection->request('GET', 'units', ['query' => $query]);
    }

    /**
     * Get a unit by its id_unit.
     * @param string $identifier 
     * @param array $queryParams 
     * @return array
     * @throws \InvalidArgumentException
     */
    public function show(string $identifier, array $queryParams = []): array
    {
        if (empty($identifier)) {
            throw new InvalidArgumentException("Parameter 'id_unit' is required.");
        }

        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        return $this->connection->request('GET', "units/{$identifier}", [
            'query' => array_filter($queryParams),
        ]);
    }

    /**
     * Add a unit to the system.
     * @param array $queryParams 
     * @param array $attributes 
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function create(array $queryParams = [], array $attributes = []): array
    {
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $requiredFields = ['handling_time', 'listing_price', 'id_offer'];
        foreach ($requiredFields as $field) {
            if (empty($attributes[$field])) {
                throw new InvalidArgumentException("Field '{$field}' is required in the request body.");
            }
        }

        return $this->connection->request('POST', 'units', [
            'query' => array_filter($queryParams),
            'body' => $attributes,
        ]);
    }

    /**
     * Update some fields of a unit.
     * @param string $identifier 
     * @param array $queryParams 
     * @param array $attributes 
     * @return array
     * @throws \InvalidArgumentException
     */
    public function update(string $identifier, array $queryParams = [], array $attributes = []): array
    {
        if (empty($identifier)) {
            throw new InvalidArgumentException("Parameter 'id_unit' is required.");
        }

        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        if (empty($attributes)) {
            throw new InvalidArgumentException("Request body cannot be empty.");
        }

        return $this->connection->request('PATCH', "units/{$identifier}", [
            'query' => array_filter($queryParams),
            'body' => $attributes,
        ]);
    }

    /**
     * Delete a unit by its ID.
     * @param string $identifier 
     * @param array $queryParams 
     * @return array
     * @throws \InvalidArgumentException
     */
    public function delete(string $identifier, array $queryParams = []): array
    {
        if (empty($identifier)) {
            throw new InvalidArgumentException("Parameter 'id_unit' is required.");
        }

        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        return $this->connection->request('DELETE', "units/{$identifier}", [
            'query' => array_filter($queryParams),
        ]);
    }
    
    /**
     * Update some fields of a given set of units in bulk.
     * @param array $queryParams 
     * @param array $unitsData 
     * @return array
     * @throws \InvalidArgumentException
     */
    public function bulkUpdate(array $queryParams = [], array $unitsData = []): array
    {
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        if (empty($unitsData)) {
            throw new InvalidArgumentException("Request body cannot be empty.");
        }

        foreach ($unitsData as $unit) {
            if (empty($unit['id_unit'])) {
                throw new InvalidArgumentException("Each unit must include 'id_unit'.");
            }

            if (empty($unit['unit_data'])) {
                throw new InvalidArgumentException("Each unit must include 'unit_data'.");
            }
        }

        return $this->connection->request('POST', "units/bulk", [
            'query' => array_filter($queryParams),
            'body' => $unitsData,
        ]);
    }
}
