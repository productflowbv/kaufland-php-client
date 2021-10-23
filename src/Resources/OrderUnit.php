<?php

namespace RemCom\KauflandPhpClient\Resources;

class OrderUnit extends Model
{
    /**
     * @param array $status
     * @return mixed
     */
    public function list(array $status = [])
    {
        return $this->connection->request('GET', 'order-units/seller/', ['query' => $this->getQuery() + array_filter(['status' => implode(',', $status)])]);
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
     * @param array $attributes
     * @return array
     */
    public function cancel($identifier, array $attributes): array
    {
        return $this->connection->request('PATCH', "order-units/{$identifier}/cancel/", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     */
    public function send($identifier, array $attributes): array
    {
        return $this->connection->request('PATCH', "order-units/{$identifier}/send/", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     */
    public function refund($identifier, array $attributes): array
    {
        return $this->connection->request('PATCH', "order-units/{$identifier}/refund/", ['body' => $attributes]);
    }
}
