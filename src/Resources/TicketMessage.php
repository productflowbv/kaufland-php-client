<?php

namespace RemCom\KauflandPhpClient\Resources;

class TicketMessage extends Model
{
    public function list()
    {
        return $this->connection->request('GET', 'ticket-messages/seller/', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier): array
    {
        return $this->connection->request('GET', "ticket-messages/{$identifier}");
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function post(array $attributes): array
    {
        return $this->connection->request('POST', "ticket-messages/", ['body' => $attributes]);
    }
}
