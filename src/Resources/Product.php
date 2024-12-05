<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Product extends Model
{
    /**
     * Get a product by EAN.
     * @param string $ean 
     * @param string $storefront
     * @param array|null $embedded 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function getByEAN(string $ean, string $storefront, array $embedded = null): array
    {
        if (empty($ean)) {
            throw new InvalidArgumentException("Parameter 'ean' is required.");
        }

        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $query = [
            'storefront' => $storefront,
        ];

        if (!empty($embedded)) {
            $query['embedded'] = implode(',', $embedded);
        }

        return $this->connection->request('GET', "products/ean/{$ean}", [
            'query' => $query,
        ]);
    }

    /**
     * Get a list of products by search term.
     * @param string $storefront 
     * @param string $query 
     * @param array|null $options 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function search(string $storefront, string $query, array $options = []): array
    {
        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        if (empty($query)) {
            throw new InvalidArgumentException("Parameter 'q' is required.");
        }

        $queryParams = [
            'storefront' => $storefront,
            'q' => $query,
        ];

        if (isset($options['limit'])) {
            $queryParams['limit'] = $options['limit'];
        }

        if (isset($options['offset'])) {
            $queryParams['offset'] = $options['offset'];
        }

        if (!empty($options['embedded'])) {
            $queryParams['embedded'] = implode(',', $options['embedded']);
        }

        return $this->connection->request('GET', 'products/search', [
            'query' => $queryParams,
        ]);
    }
    
    /**
     * Get a product by its id_product.
     * @param string $idProduct 
     * @param string $storefront 
     * @param array|null $embedded
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function getById(string $idProduct, string $storefront, array $embedded = null): array
    {
        if (empty($idProduct)) {
            throw new InvalidArgumentException("Parameter 'id_product' is required.");
        }

        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $query = [
            'storefront' => $storefront,
        ];

        if (!empty($embedded)) {
            $query['embedded'] = implode(',', $embedded);
        }

        return $this->connection->request('GET', "products/{$idProduct}", [
            'query' => $query,
        ]);
    }

}