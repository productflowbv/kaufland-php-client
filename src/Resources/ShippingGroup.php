<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class ShippingGroup extends Model
{
    /**
     * Get the list of your predefined shipping groups.
     * @param array $queryParams 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function list(array $queryParams = []): array
    {
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        return $this->connection->request('GET', 'shipping-groups', [
            'query' => array_filter($this->getQuery() + $queryParams),
        ]);
    }

    /**
     * Get a shipping group by its ID.
     * @param string $idShippingGroup
     * @param string $storefront 
     * @throws \InvalidArgumentException
     * @return array|string 
     */
    public function show(string $idShippingGroup, string $storefront): array
    {
        if (empty($idShippingGroup)) {
            throw new InvalidArgumentException("Parameter 'id_shipping_group' is required.");
        }

        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        return $this->connection->request('GET', "shipping-groups/{$idShippingGroup}", [
            'query' => ['storefront' => $storefront],
        ]);
    }

}
