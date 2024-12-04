<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class ProductData extends Model
{
    /**
     * Get a list of all product data import files.
     * @param array $queryParams
     * @return array|string
     */
    public function list(array $queryParams = []): array
    {
        $query = $this->getQuery() + array_filter($queryParams);

        return $this->connection->request('GET', 'product-data/import-files', [
            'query' => $query,
        ]);
    }

    /**
     * Saves an URL where a new import file is located.
     * @param string $url 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function create(string $url): array
    {
        if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("Parameter 'url' is required and must be a valid URL.");
        }

        return $this->connection->request('POST', 'product-data/import-files', [
            'body' => ['url' => $url],
        ]);
    }

    /**
     * Get an import file by its ID.
     * @param string $idImportFile 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function getImportFileById(string $idImportFile): array
    {
        if (empty($idImportFile)) {
            throw new InvalidArgumentException("Parameter 'id_import_file' is required.");
        }

        return $this->connection->request('GET', "product-data/import-files/{$idImportFile}");
    }

    /**
     * Get the product data for a specific EAN.
     * @param string $ean 
     * @param string $locale 
     * @throws \InvalidArgumentException
     * @return array|string 
     */
    public function show(string $ean, string $locale): array
    {
        if (empty($ean)) {
            throw new InvalidArgumentException("Parameter 'ean' is required.");
        }

        if (empty($locale)) {
            throw new InvalidArgumentException("Parameter 'locale' is required.");
        }

        return $this->connection->request('GET', "product-data/{$ean}", [
            'query' => ['locale' => $locale],
        ]);
    }

    /**
     * Add or replace product data for an EAN.
     * @param string $locale 
     * @param array $data 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function update(string $locale, array $data): array
    {
        if (empty($locale)) {
            throw new InvalidArgumentException("Parameter 'locale' is required.");
        }

        if (empty($data['ean']) || !is_array($data['ean'])) {
            throw new InvalidArgumentException("Parameter 'ean' is required and must be an array.");
        }

        if (empty($data['attributes']) || !is_array($data['attributes'])) {
            throw new InvalidArgumentException("Parameter 'attributes' is required and must be an array.");
        }

        return $this->connection->request('PUT', 'product-data', [
            'query' => ['locale' => $locale],
            'body' => $data,
        ]);
    }

    /**
     * Partially update product data for a specific product.
     * @param string $locale 
     * @param array $data 
     * @throws \InvalidArgumentException 
     * @return array|string
     */
    public function updatePartial(string $locale, array $data): array
    {
        if (empty($locale)) {
            throw new InvalidArgumentException("Parameter 'locale' is required.");
        }

        if (empty($data['ean']) || !is_array($data['ean'])) {
            throw new InvalidArgumentException("Parameter 'ean' is required and must be an array.");
        }

        if (empty($data['attributes']) || !is_array($data['attributes'])) {
            throw new InvalidArgumentException("Parameter 'attributes' is required and must be an array.");
        }

        return $this->connection->request('PATCH', 'product-data', [
            'query' => ['locale' => $locale],
            'body' => $data,
        ]);
    }

    /**
     * Delete the product data for a specific EAN.
     * @param string $ean 
     * @param string $locale 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function delete(string $ean, string $locale): array
    {
        if (empty($ean)) {
            throw new InvalidArgumentException("Parameter 'ean' is required.");
        }

        if (empty($locale)) {
            throw new InvalidArgumentException("Parameter 'locale' is required.");
        }

        return $this->connection->request('DELETE', "product-data/{$ean}", [
            'query' => ['locale' => $locale],
        ]);
    }

    /**
     * Get the process status for your provided product data via EAN.
     * @param string $ean 
     * @param string $locale 
     * @throws \InvalidArgumentException 
     * @return array|string
     */
    public function status(string $ean, string $locale): array
    {
        if (empty($ean)) {
            throw new InvalidArgumentException("Parameter 'ean' is required.");
        }

        if (empty($locale)) {
            throw new InvalidArgumentException("Parameter 'locale' is required.");
        }

        return $this->connection->request('GET', "product-data/status/{$ean}", [
            'query' => ['locale' => $locale],
        ]);
    }

}
