<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class OrderInvoice extends Model
{
    /**
     * Get a list of order invoices.
     * @param array $queryParams
     * @return array|string
     */
    public function list(array $queryParams = []): array
    {
        $query = $this->getQuery() + array_filter($queryParams);

        return $this->connection->request('GET', 'order-invoices', [
            'query' => $query,
        ]);
    }

    /**
     * Get an order invoice by id_order and id_invoice.
     * @param string $idOrder 
     * @param string $idInvoice
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function show(string $idOrder, string $idInvoice): array
    {
        if (empty($idOrder)) {
            throw new InvalidArgumentException("Parameter 'id_order' is required.");
        }
        if (empty($idInvoice)) {
            throw new InvalidArgumentException("Parameter 'id_invoice' is required.");
        }

        return $this->connection->request('GET', "order-invoices/{$idOrder}/{$idInvoice}");
    }

    /**
     * Upload an order invoice to a given order.
     * @param string $idOrder
     * @param array $attributes
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function create(string $idOrder, array $attributes): array
    {
        if (empty($idOrder)) {
            throw new InvalidArgumentException("Parameter 'id_order' is required.");
        }

        if (empty($attributes['original_name']) || empty($attributes['mime_type']) || empty($attributes['content'])) {
            throw new InvalidArgumentException("Parameters 'original_name', 'mime_type', and 'content' are required in the body.");
        }

        return $this->connection->request('POST', "order-invoices/{$idOrder}", [
            'body' => $attributes,
        ]);
    }

    /**
     * Delete an order invoice by id_order and id_invoice.
     *
     * @param string $idOrder
     * @param string $idInvoice
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function delete(string $idOrder, string $idInvoice): array
    {
        if (empty($idOrder)) {
            throw new InvalidArgumentException("Parameter 'id_order' is required.");
        }
        if (empty($idInvoice)) {
            throw new InvalidArgumentException("Parameter 'id_invoice' is required.");
        }

        return $this->connection->request('DELETE', "order-invoices/{$idOrder}/{$idInvoice}");
    }
}
