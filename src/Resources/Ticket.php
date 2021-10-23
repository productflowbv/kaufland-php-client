<?php

namespace RemCom\KauflandPhpClient\Resources;

class Ticket extends Model
{
    public function list(array $status = [], array $open_reason = [], array $topic = [])
    {
        return $this->connection->request('GET', 'tickets/seller/', ['query' => $this->getQuery() + array_filter([
                'status' => implode(',', $status),
                'open_reason' => implode(',', $open_reason),
                'topic' => implode(',', $topic)
            ])]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier): array
    {
        return $this->connection->request('GET', "tickets/{$identifier}");
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function create(array $attributes): array
    {
        return $this->connection->request('POST', "tickets/", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function close($identifier): array
    {
        return $this->connection->request('PATCH', "tickets/{$identifier}/close");
    }
}
