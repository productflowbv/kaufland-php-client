<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class TicketMessage extends Model
{
    /**
     * Get a list of ticket messages.
     * @param array $filters 
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function list(array $filters = []): array
    {
        if (isset($filters['limit']) && (!is_int($filters['limit']) || $filters['limit'] <= 0)) {
            throw new InvalidArgumentException("Parameter 'limit' must be a positive integer.");
        }
        if (isset($filters['offset']) && (!is_int($filters['offset']) || $filters['offset'] < 0)) {
            throw new InvalidArgumentException("Parameter 'offset' must be a non-negative integer.");
        }

        return $this->connection->request('GET', 'tickets/messages', ['query' => array_filter($filters)]);
    }

    /**
     * Create a new message for a ticket.
     * @param string $idTicket
     * @param array $attributes 
     * @throws \InvalidArgumentException
     * @return array
     */
    public function create(string $idTicket, array $attributes): array
    {
        if (empty($idTicket)) {
            throw new InvalidArgumentException("Parameter 'id_ticket' is required.");
        }

        if (empty($attributes['text'])) {
            throw new InvalidArgumentException("Parameter 'text' is required.");
        }

        if (!isset($attributes['interim_notice'])) {
            throw new InvalidArgumentException("Parameter 'interim_notice' is required.");
        }

        if (!empty($attributes['ticket_message_files'])) {
            foreach ($attributes['ticket_message_files'] as $file) {
                if (empty($file['filename']) || empty($file['mime_type']) || empty($file['data'])) {
                    throw new InvalidArgumentException("Each file must include 'filename', 'mime_type', and 'data'.");
                }
            }
        }

        return $this->connection->request('POST', "tickets/{$idTicket}/messages", ['body' => $attributes]);
    }
}
