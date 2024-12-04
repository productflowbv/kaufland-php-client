<?php 

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Buybox extends Model 
{

    /**
     * Get a list of offers rankings for a product
     * @param array $queryParams
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function list(array $queryParams = []) 
    {
        if (empty($queryParams['id_product'])) {
            throw new InvalidArgumentException("Parameter 'id_product' is required.");
        }
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }
        if (empty($queryParams['condition'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $query = $this->getQuery() + $queryParams;

        return $this->connection->request('GET', 'buybox', ['query' => $query]);
    }
}