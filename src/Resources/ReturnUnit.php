<?php

namespace RemCom\KauflandPhpClient\Resources;

class ReturnUnit extends Model
{
    /**
     * @param array $status
     * @return mixed
     */
    public function list(array $status = [])
    {
        return $this->connection->request('GET', 'return-units/seller/', ['query' => $this->getQuery() + array_filter(['status' => implode(',', $status)])]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier): array
    {
        return $this->connection->request('GET', "return-units/{$identifier}");
    }

    /**
     * @param $identifier
     * @return array
     */
    public function accept($identifier): array
    {
        return $this->connection->request('PATCH', "return-units/{$identifier}/accept/");
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     */
    public function reject($identifier, array $attributes): array
    {
        return $this->connection->request('PATCH', "return-units/{$identifier}/reject/", ['body' => $attributes]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function repair($identifier): array
    {
        return $this->connection->request('PATCH', "return-units/{$identifier}/repair/");
    }

    /**
     * @param $identifier
     * @param array $attributes
     * @return array
     */
    public function clarify($identifier, array $attributes): array
    {
        return $this->connection->request('PATCH', "return-units/{$identifier}/clarify/", ['body' => $attributes]);
    }
}
