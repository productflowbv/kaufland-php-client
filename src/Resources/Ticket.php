<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Ticket extends Model
{
    /**
     * Get a list of tickets.
     * @param array $filters 
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->connection->request('GET', 'tickets', ['query' => array_filter($filters)]);
    }

    /**
     * Get a ticket by ID with optional query parameters.
     * @param string $idTicket 
     * @param array $queryParams 
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function show(string $idTicket, array $queryParams = []): array
    {
        if (empty($idTicket)) {
            throw new InvalidArgumentException("Parameter 'id_ticket' is required.");
        }

        return $this->connection->request('GET', "tickets/{$idTicket}", ['query' => array_filter($queryParams)]);
    }

    /**
     * Open a ticket.
     * @param array $attributes 
     * @throws \InvalidArgumentException
     * @return array
     */
    public function create(array $attributes): array
    {
        if (empty($attributes['id_order_unit']) || !is_array($attributes['id_order_unit'])) {
            throw new InvalidArgumentException("Parameter 'id_order_unit' is required and must be an array.");
        }

        if (empty($attributes['reason'])) {
            throw new InvalidArgumentException("Parameter 'reason' is required.");
        }

        if (empty($attributes['message'])) {
            throw new InvalidArgumentException("Parameter 'message' is required.");
        }

        return $this->connection->request('POST', "tickets", ['body' => $attributes]);
    }

    /**
     * Close a ticket by ID.
     * @param string $idTicket 
     * @throws \InvalidArgumentException
     * @return array
     */
    public function close(string $idTicket): array
    {
        if (empty($idTicket)) {
            throw new InvalidArgumentException("Parameter 'id_ticket' is required.");
        }

        return $this->connection->request('PATCH', "tickets/{$idTicket}/close");
    }
}
