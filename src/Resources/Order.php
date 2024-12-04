<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Order extends Model
{
    /**
     * Get a list of orders.
     * @param array $queryParams
     * @return array|string
     */
    public function list(array $queryParams = []): array
    {
        $query = $this->getQuery() + array_filter($queryParams);

        return $this->connection->request('GET', 'orders', [
            'query' => $query,
        ]);
    }

    /**
     * Get an order by id_order.
     * @param string $idOrder
     * @param array|null $embedded
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function show(string $idOrder, array $embedded = null): array
    {
        if (empty($idOrder)) {
            throw new InvalidArgumentException("Parameter 'id_order' is required.");
        }

        $query = $this->getQuery();
        if (!empty($embedded)) {
            $query['embedded'] = implode(',', $embedded);
        }

        return $this->connection->request('GET', "orders/{$idOrder}", [
            'query' => $query,
        ]);
    }

}
