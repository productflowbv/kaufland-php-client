<?php

namespace RemCom\KauflandPhpClient\Resources;

class Model
{
    protected $connection;

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $offset;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function setOffset(int $offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @param string $column
     * @param $operation
     * @param null $value
     * @return $this
     */
    public function filter(string $column, $operation, $value = null)
    {
        if (is_null($value)) {
            $value = $operation;
            $operation = 'eq';
        }

        $this->filters[$column][$operation] = $value;
        return $this;
    }

    /**
     * @return array
     */
    protected function getQuery(): array
    {
        $query = $this->filters;
        $query['limit'] = $this->getLimit();
        $query['offset'] = $this->getOffset();

        return array_filter($query);
    }
}
