<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class OrderUnit extends Model
{
    /**
     * Get a list of order units.
     * @param array $queryParams
     * @return array|string 
     */
    public function list(array $queryParams = []): array
    {
        $query = $this->getQuery() + array_filter($queryParams);

        return $this->connection->request('GET', 'order-units', [
            'query' => $query,
        ]);
    }

    /**
     * Get an order unit by id_order_unit.
     * @param string $idOrderUnit
     * @param array|null $embedded
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function show(string $idOrderUnit, array $embedded = null): array
    {
        if (empty($idOrderUnit)) {
            throw new InvalidArgumentException("Parameter 'id_order_unit' is required.");
        }

        $query = $this->getQuery();
        if (!empty($embedded)) {
            $query['embedded'] = implode(',', $embedded);
        }

        return $this->connection->request('GET', "order-units/{$idOrderUnit}", [
            'query' => $query,
        ]);
    }

    /**
     * Mark an order unit to be in fulfillment.
     * @param string $idOrderUnit
     * @throws \InvalidArgumentException 
     * @return array|string
     */
    public function fulfil(string $idOrderUnit): array
    {
        if (empty($idOrderUnit)) {
            throw new InvalidArgumentException("Parameter 'id_order_unit' is required.");
        }

        return $this->connection->request('PATCH', "order-units/{$idOrderUnit}/fulfil");
    }

    /**
     * Cancel an order unit.
     * @param string $idOrderUnit
     * @param array $attributes
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function cancel(string $idOrderUnit, array $attributes): array
    {
        if (empty($idOrderUnit)) {
            throw new InvalidArgumentException("Parameter 'id_order_unit' is required.");
        }

        if (empty($attributes['reason'])) {
            throw new InvalidArgumentException("Parameter 'reason' is required in the body.");
        }

        return $this->connection->request('PATCH', "order-units/{$idOrderUnit}/cancel", [
            'body' => $attributes,
        ]);
    }

    /**
     * Mark an order unit as sent.
     * @param string $idOrderUnit
     * @param array $attributes
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function send(string $idOrderUnit, array $attributes): array
    {
        if (empty($idOrderUnit)) {
            throw new InvalidArgumentException("Parameter 'id_order_unit' is required.");
        }

        if (empty($attributes['tracking_numbers']) || !is_array($attributes['tracking_numbers'])) {
            throw new InvalidArgumentException("Parameter 'tracking_numbers' is required and must be an array.");
        }

        if (empty($attributes['carrier_code'])) {
            throw new InvalidArgumentException("Parameter 'carrier_code' is required.");
        }

        return $this->connection->request('PATCH', "order-units/{$idOrderUnit}/send", [
            'body' => $attributes,
        ]);
    }

    /**
     * Send a refund to a customer for a particular order unit.
     * @param string $idOrderUnit
     * @param array $attributes
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function refund(string $idOrderUnit, array $attributes): array
    {
        if (empty($idOrderUnit)) {
            throw new InvalidArgumentException("Parameter 'id_order_unit' is required.");
        }

        if (empty($attributes['amount']) || !is_numeric($attributes['amount']) || $attributes['amount'] <= 0) {
            throw new InvalidArgumentException("Parameter 'amount' is required and must be a positive number in Eurocents.");
        }

        if (empty($attributes['reason'])) {
            throw new InvalidArgumentException("Parameter 'reason' is required.");
        }

        return $this->connection->request('PATCH', "order-units/{$idOrderUnit}/refund", [
            'body' => $attributes,
        ]);
    }
}
