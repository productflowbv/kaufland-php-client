<?php

namespace ProductFlow\KauflandPhpClient\Resources;

use ProductFlow\KauflandPhpClient\Connection;

class Model
{
    protected Connection $connection;

    protected array $filters = [];

    protected int $limit = 20;

    protected int $offset = 0;

    protected array $query = [];

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): static
    {
        $this->limit = $limit;
        return $this;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): static
    {
        $this->offset = $offset;
        return $this;
    }

    public function setFilter(string $column, $operation, $value = null): static
    {
        if (is_null($value)) {
            $value = $operation;
            $operation = 'eq';
        }

        $this->filters[$column][$operation] = $value;
        return $this;
    }

    public function getQuery(): array
    {
        return array_merge(
            $this->query,
            $this->filters,
            [ 'limit' => $this->getLimit(), 'offset' => $this->getOffset() ]
        );
    }

    public function setQuery(string|array $key, mixed $value = null): static
    {
        if (is_array($key)) {
            $this->query = $key;
        } else {
            $this->query[$key] = $value;
        }

        return $this;
    }
}
