<?php

namespace RemCom\KauflandPhpClient\Resources;

class Model
{
    protected $connection;

    /**
     * @var int
     */
    protected int $limit = 30;

    /**
     * @var int
     */
    protected int $offset = 0;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }


    /**
     * @return array
     */
    protected function getQuery(): array
    {
//        $query = $this->filters;
        $query['limit'] = $this->getLimit();
//        $query['offset'] = $this->getPage();
        return $query;
    }
}