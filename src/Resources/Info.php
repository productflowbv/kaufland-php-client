<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Info extends Model
{
    /**
     * Get VAT indicators mapping for a given storefront.
     * @param string $storefront
     * @throws \InvalidArgumentException
     * @return array|string
     */
    public function getVatIndicators(string $storefront = null): array
    {
        $query = $this->getQuery();
        if ($storefront) {
            $query['storefront'] = $storefront;
        }

        return $this->connection->request('GET', 'info/vat-indicators', [
            'query' => $query,
        ]);
    }

    /**
     * Get all available values for the parameter 'locale'.
     * @return array|string
     */
    public function getLocales(): array
    {
        return $this->connection->request('GET', 'info/locale');
    }

    /**
     * Get current seller's available values for the parameter 'storefront'.
     * @return array|string
     */
    public function getStorefronts(): array
    {
        return $this->connection->request('GET', 'info/storefront');
    }
}
