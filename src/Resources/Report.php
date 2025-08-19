<?php

namespace ProductFlow\KauflandPhpClient\Resources;

class Report extends Model
{
    /**
     * @return mixed
     */
    public function list()
    {
        return $this->connection->request('GET', 'reports/', ['query' => $this->getQuery()]);
    }

    /**
     * @param $identifier
     * @return array
     */
    public function show($identifier)
    {
        return $this->connection->request('GET', "reports/{$identifier}");
    }

    /**
     * @return array
     */
    public function accountListing()
    {
        return $this->connection->request('POST', 'reports/account-listing', ['query' => $this->getQuery()]);
    }

    /**
     * @return array
     */
    public function accountListingWithShopPrice()
    {
        return $this->connection->request('POST', 'reports/account-listing-with-shop-price');
    }

    /**
     * @return array
     */
    public function bookings()
    {
        return $this->connection->request('POST', 'reports/bookings');
    }

    /**
     * @return array
     */
    public function bookingsNew()
    {
        return $this->connection->request('POST', 'reports/bookings-new');
    }

    /**
     * @return array
     */
    public function eansNotFound()
    {
        return $this->connection->request('POST', 'reports/eans-not-found');
    }

    /**
     * @return array
     */
    public function productDataChanges()
    {
        return $this->connection->request('POST', 'reports/product-data-changes');
    }

    /**
     * @return array
     */
    public function cancellations()
    {
        return $this->connection->request('POST', 'reports/cancellations');
    }

    /**
     * @return array
     */
    public function competitorsComparer()
    {
        return $this->connection->request('POST', 'reports/competitors-comparer');
    }

    /**
     * @return array
     */
    public function sales()
    {
        return $this->connection->request('POST', 'reports/sales');
    }

    /**
     * @return array
     */
    public function salesNew()
    {
        return $this->connection->request('POST', 'reports/sales-new');
    }

    /**
     * @return array
     */
    public function productDataImportFileErrors()
    {
        return $this->connection->request('POST', 'reports/product-data-import-file-errors');
    }
}
