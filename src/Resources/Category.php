<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Category extends Model
{
    /**
     * Get complete category tree.
     * @param array $queryParams
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function tree(array $queryParams = [])
    {
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $query = $this->getQuery() + $queryParams;

        return $this->connection->request('GET', 'categories/tree', ['query' => $query]);
    }

    /**
     * Get category list by search term.
     * @param array $queryParams
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function list(array $queryParams = [])
    {
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $query = $this->getQuery() + $queryParams;

        return $this->connection->request('GET', 'categories', ['query' => $query]);
    }

    /**
     * Get a category by id_category.
     * @param array $queryParams
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function show(array $queryParams = [])
    {
        if (empty($queryParams['id_category'])) {
            throw new InvalidArgumentException("Parameter 'id_category' is required.");
        }
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $idCategory = $queryParams['id_category'];
        unset($queryParams['id_category']);

        $query = $this->getQuery() + $queryParams;

        return $this->connection->request('GET', "categories/{$idCategory}", ['query' => array_filter($query)]);
    }

    /**
     * Guess potential categories for a product based on its data.
     * @param array $queryParams
     * @param array $bodyParams
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function decide(array $queryParams = [], array $bodyParams = []): array
    {
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }
        if (empty($queryParams['locale'])) {
            throw new InvalidArgumentException("Parameter 'locale' is required.");
        }
    
        // Sprawdź wymagane pola w ciele żądania
        if (empty($bodyParams['item']) || !is_array($bodyParams['item'])) {
            throw new InvalidArgumentException("Field 'item' is required in the body and must be an array.");
        }
        if (empty($bodyParams['item']['title'])) {
            throw new InvalidArgumentException("Field 'item.title' is required in the body.");
        }
        if (empty($bodyParams['item']['description'])) {
            throw new InvalidArgumentException("Field 'item.description' is required in the body.");
        }
        if (empty($bodyParams['item']['manufacturer'])) {
            throw new InvalidArgumentException("Field 'item.manufacturer' is required in the body.");
        }
        if (empty($bodyParams['price'])) {
            throw new InvalidArgumentException("Field 'price' is required in the body.");
        }
    
        $query = $this->getQuery() + $queryParams;
    
        return $this->connection->request('POST', 'categories/decide', [
            'query' => array_filter($query),
            'body' => $bodyParams,
        ]);
    }
}
