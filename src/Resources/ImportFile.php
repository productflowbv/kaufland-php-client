<?php

namespace RemCom\KauflandPhpClient\Resources;

class ImportFile extends Model
{
    public function list(array $status = [], array $type = [])
    {
        return $this->connection->request('GET', 'import-files/', ['query' => $this->getQuery() + array_filter(['status' => implode(',', $status), 'type' => implode(',', $type)])]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier)
    {
        return $this->connection->request('GET', "import-files/{$identifier}");
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function post(array $attributes): array
    {
        return $this->connection->request('POST', "import-files/", ['body' => $attributes]);
    }
}