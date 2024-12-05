<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Attribute extends Model
{
    /**
     * Get a list of all available attributes for a specific language.
     * @param array $queryParams
     * @return array|string
     */
    public function list(array $queryParams = [])
    {
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $query = $this->getQuery() + $queryParams;

        return $this->connection->request('GET', 'attributes', ['query' => $query]);
    }

    /**
     * Get a list of attributes by a search term.
     * @param array $queryParams
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function search(array $queryParams = [])
    {
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }
        if (empty($queryParams['q'])) {
            throw new InvalidArgumentException("Parameter 'q' is required.");
        }

        $query = $this->getQuery() + $queryParams;

        return $this->connection->request('GET', 'attributes/search', ['query' => $query]);
    }

    /**
     * Get an attribute by id_attribute.
     * @param array $queryParams
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function show(array $queryParams = [])
    {
        if (empty($queryParams['id_attribute'])) {
            throw new InvalidArgumentException("Parameter 'id_attribute' is required.");
        }
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $identifier = $queryParams['id_attribute'];
        unset($queryParams['id_attribute']);
    
        $query = $this->getQuery() + $queryParams;

        return $this->connection->request('GET', "attributes/{$identifier}", ['query' => $query]);
    }

    /**
     * Get an attribute by its name.
     * @param array $queryParams
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function getByName(array $queryParams = [])
    {
        if (empty($queryParams['name'])) {
            throw new InvalidArgumentException("Parameter 'name' is required.");
        }
        if (empty($queryParams['storefront'])) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $name = $queryParams['name'];
        unset($queryParams['name']);

        $query = $this->getQuery() + $queryParams;

        return $this->connection->request('GET', "attributes/by-name/{$name}", ['query' => $query]);
    }

    /**
     * Get a list of shared-set for a given attribute id by a search term.
     * @param array $queryParams
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function showSharedSet(array $queryParams = [])
    {
        if (empty($queryParams['id_attribute'])) {
            throw new InvalidArgumentException("Parameter 'id_attribute' is required.");
        }
        if (empty($queryParams['locale'])) {
            throw new InvalidArgumentException("Parameter 'locale' is required.");
        }

        $identifier = $queryParams['id_attribute'];
        unset($queryParams['id_attribute']);
    
        $query = $this->getQuery() + $queryParams;
    
        return $this->connection->request('GET', "attributes/{$identifier}/shared-set", ['query' => $query]);
    }

    /**
     * Get the URL for a CSV file containing the shared set values for a specific attribute ID.
     * @param array $queryParams
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function showSharedSetAsCSV(array $queryParams = [])
    {
        if (empty($queryParams['id_attribute'])) {
            throw new InvalidArgumentException("Parameter 'id_attribute' is required.");
        }
        if (empty($queryParams['locale'])) {
            throw new InvalidArgumentException("Parameter 'locale' is required.");
        }

        $identifier = $queryParams['id_attribute'];
        unset($queryParams['id_attribute']);

        $query = $this->getQuery() + $queryParams;

        return $this->connection->request('GET', "attributes/{$identifier}/shared-set-values", ['query' => $query]);    
    }
}
