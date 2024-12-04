<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class ReturnUnit extends Model
{
    /**
     * Get a list of return units.
     * @param array $queryParams 
     * @throws \InvalidArgumentException 
     * @return array|string
     */
    public function list(array $queryParams = []): array
    {
        if (isset($queryParams['status']) && is_array($queryParams['status'])) {
            $queryParams['status'] = implode(',', $queryParams['status']);
        }

        return $this->connection->request('GET', "return-units", [
            'query' => array_filter($queryParams),
        ]);
    }

    /**
     * Get a return unit by its ID.
     *
     * @param string $idReturnUnit 
     * @param array|null $embedded 
     * @throws \InvalidArgumentException
     * @return array|string 
     */
    public function show(string $idReturnUnit, ?array $embedded = null): array
    {
        if (empty($idReturnUnit)) {
            throw new InvalidArgumentException("Parameter 'id_return_unit' is required.");
        }

        $query = [];
        if (!empty($embedded)) {
            $query['embedded'] = implode(',', $embedded);
        }

        return $this->connection->request('GET', "return-units/{$idReturnUnit}", [
            'query' => $query,
        ]);
    }

    /**
     * Mark a return unit as return_accepted.
     * @param string $idReturnUnit 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function accept(string $idReturnUnit): array
    {
        if (empty($idReturnUnit)) {
            throw new InvalidArgumentException("Parameter 'id_return_unit' is required.");
        }

        return $this->connection->request('PATCH', "return-units/{$idReturnUnit}/accept");
    }

    /**
     * Reject a return unit.
     * @param string $idReturnUnit 
     * @param string $message 
     * @throws \InvalidArgumentException 
     * @return array|string
     */
    public function reject(string $idReturnUnit, string $message): array
    {
        if (empty($idReturnUnit)) {
            throw new InvalidArgumentException("Parameter 'id_return_unit' is required.");
        }

        if (empty($message)) {
            throw new InvalidArgumentException("Parameter 'message' is required.");
        }

        $body = [
            'message' => $message,
        ];

        return $this->connection->request('PATCH', "return-units/{$idReturnUnit}/reject", [
            'body' => $body,
        ]);
    }

    /**
     * Repair a return unit.
     * @param string $idReturnUnit 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function repair(string $idReturnUnit): array
    {
        if (empty($idReturnUnit)) {
            throw new InvalidArgumentException("Parameter 'id_return_unit' is required.");
        }

        return $this->connection->request('PATCH', "return-units/{$idReturnUnit}/repair");
    }

    /**
     * Clarify a raturn unit.
     * @param string $idReturnUnit 
     * @param string $message 
     * @throws \InvalidArgumentException 
     * @return array|string
     */
    public function clarify(string $idReturnUnit, string $message): array
    {
        if (empty($idReturnUnit)) {
            throw new InvalidArgumentException("Parameter 'id_return_unit' is required.");
        }

        if (empty($message)) {
            throw new InvalidArgumentException("Parameter 'message' is required.");
        }

        $body = [
            'message' => $message,
        ];

        return $this->connection->request('PATCH', "return-units/{$idReturnUnit}/clarify", [
            'body' => $body,
        ]);
    }
}
