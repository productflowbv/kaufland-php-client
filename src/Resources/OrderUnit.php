<?php

namespace RemCom\KauflandPhpClient\Resources;

class OrderUnit extends Model
{
    public function list(array $status = [])
    {
        return $this->connection->request('GET', 'order-units/seller/', ['query' => $this->getQuery() + ['status' => implode(',', $status)]]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier): array
    {
        return $this->connection->request('GET', "order-units/{$identifier}");
    }

    /**
     * @param $identifier
     * @return array
     */
    public function fulfil($identifier): array
    {
        return $this->connection->request('PATCH', "order-units/{$identifier}/fulfil/");
    }

    /**
     * @param $identifier
     * @return array
     */
    public function cancel($identifier): array
    {
        return $this->connection->request('PATCH', "order-units/{$identifier}/cancel/");
    }

    /**
     * @param $identifier
     * @return array
     */
    public function send($identifier): array
    {
        return $this->connection->request('PATCH', "order-units/{$identifier}/send/");
    }

    /**
     * @param $identifier
     * @return array
     */
    public function refund($identifier): array
    {
        return $this->connection->request('PATCH', "order-units/{$identifier}/refund/");
    }
}