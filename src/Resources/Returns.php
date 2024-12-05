<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Returns extends Model
{
    /**
     * Get a list of returns.
     * @param array $queryParams 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function list(array $queryParams = []): array
    {
        if (isset($queryParams['status']) && is_array($queryParams['status'])) {
            $queryParams['status'] = implode(',', $queryParams['status']);
        }

        return $this->connection->request('GET', 'returns', [
            'query' => array_filter($this->getQuery() + $queryParams),
        ]);
    }

    /**
     * Get a return by its ID.
     * @param string $idReturn 
     * @param array|null $embedded 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function show(string $idReturn, ?array $embedded = null): array
    {
        if (empty($idReturn)) {
            throw new InvalidArgumentException("Parameter 'id_return' is required.");
        }

        $query = array_filter([
            'embedded' => $embedded ? implode(',', $embedded) : null,
        ]);

        return $this->connection->request('GET', "returns/{$idReturn}", [
            'query' => $query,
        ]);
    }

    /**
     * Initialize a return.
     * @param array $attributes 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function create(array $attributes): array
    {
        if (empty($attributes['id_order_unit'])) {
            throw new InvalidArgumentException("Parameter 'id_order_unit' is required.");
        }

        if (empty($attributes['reason'])) {
            throw new InvalidArgumentException("Parameter 'reason' is required.");
        }

        if (empty($attributes['note'])) {
            throw new InvalidArgumentException("Parameter 'note' is required.");
        }

        return $this->connection->request('POST', "returns", [
            'body' => $attributes,
        ]);
    }

    /**
     * Add one or more order units to an already existing return.
     * @param string $idReturn
     * @param array $attributes 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function update(string $idReturn, array $attributes): array
    {
        if (empty($idReturn)) {
            throw new InvalidArgumentException("Parameter 'id_return' is required.");
        }

        if (empty($attributes['id_order_unit'])) {
            throw new InvalidArgumentException("Parameter 'id_order_unit' is required in the request body.");
        }

        if (empty($attributes['reason'])) {
            throw new InvalidArgumentException("Parameter 'reason' is required in the request body.");
        }

        if (empty($attributes['note'])) {
            throw new InvalidArgumentException("Parameter 'note' is required in the request body.");
        }

        return $this->connection->request('PUT', "returns/{$idReturn}", [
            'body' => $attributes,
        ]);
    }
}
