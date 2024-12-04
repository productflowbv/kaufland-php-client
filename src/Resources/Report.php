<?php

namespace ProductFlow\KauflandPhpClient\Resources;
use \InvalidArgumentException;

class Report extends Model
{
    /**
     * Get a list of all reports.
     * @param array $queryParams
     * @return array|string
     */
    public function list(array $queryParams = []): array
    {
        $query = $this->getQuery() + array_filter($queryParams);

        return $this->connection->request('GET', 'reports', [
            'query' => $query,
        ]);
    }

    /**
     * Get meta-data for a single report by ID.
     * @param string $idReport 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function show(string $idReport): array
    {
        if (empty($idReport)) {
            throw new InvalidArgumentException("Parameter 'id_report' is required.");
        }

        return $this->connection->request('GET', "reports/{$idReport}");
    }

    /**
     * Queue an inventory report.
     * @param string $storefront 
     * @param string|null $version 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function accountListing(string $storefront, ?string $version = null): array
    {
        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $query = ['storefront' => $storefront];

        if (!empty($version)) {
            $query['version'] = $version;
        }

        return $this->connection->request('POST', "reports/account-listing", [
            'query' => $query,
        ]);
    }

    /**
     * Queue a bookings report.
     * @param string $storefront
     * @param string $dateFrom 
     * @param string $dateTo 
     * @param string|null $version
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function bookingsNew(string $storefront, string $dateFrom, string $dateTo, ?string $version = null): array
    {
        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        if (empty($dateFrom)) {
            throw new InvalidArgumentException("Parameter 'date_from' is required.");
        }

        if (empty($dateTo)) {
            throw new InvalidArgumentException("Parameter 'date_to' is required.");
        }

        $query = ['storefront' => $storefront];

        if (!empty($version)) {
            $query['version'] = $version;
        }

        $body = [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];

        return $this->connection->request('POST', "reports/bookings-new", [
            'query' => $query,
            'body' => $body,
        ]);
    }

    /**
     * Queue an EANs not found report.
     * @param string $storefront 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function eansNotFound(string $storefront): array
    {
        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        return $this->connection->request('POST', "reports/eans-not-found", [
            'query' => ['storefront' => $storefront],
        ]);
    }

    /**
     * Queue a product data changes report.
     * @param string $storefront 
     * @throws \InvalidArgumentException 
     * @return array|string
     */
    public function productDataChanges(string $storefront): array
    {
        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        return $this->connection->request('POST', "reports/product-data-changes", [
            'query' => ['storefront' => $storefront],
        ]);
    }

    /**
     * Queue a cancellations report.
     * @param string $storefront 
     * @param string|null $cancellationType 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function cancellations(string $storefront, ?string $cancellationType = null): array
    {
        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        $query = ['storefront' => $storefront];

        if (!empty($cancellationType)) {
            $query['cancellation_type'] = $cancellationType;
        }

        return $this->connection->request('POST', "reports/cancellations", [
            'query' => $query,
        ]);
    }

    /**
     * Queue a competitora comparison report.
     * @param string $storefront 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function competitorsComparer(string $storefront): array
    {
        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        return $this->connection->request('POST', "reports/competitors-comparer", [
            'query' => ['storefront' => $storefront],
        ]);
    }

    /**
     * Queue a sales report.
     * @param string $storefront 
     * @param string $dateFrom
     * @param string $dateTo 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function salesNew(string $storefront, string $dateFrom, string $dateTo): array
    {
        if (empty($storefront)) {
            throw new InvalidArgumentException("Parameter 'storefront' is required.");
        }

        if (empty($dateFrom)) {
            throw new InvalidArgumentException("Parameter 'date_from' is required.");
        }

        if (empty($dateTo)) {
            throw new InvalidArgumentException("Parameter 'date_to' is required.");
        }

        $body = [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];

        return $this->connection->request('POST', "reports/sales-new", [
            'query' => ['storefront' => $storefront],
            'body' => $body,
        ]);
    }

    /**
     * Queue a report for errors in a product data import file.
     * @param string $idFileImport 
     * @throws \InvalidArgumentException 
     * @return array|string 
     */
    public function productDataImportFileErrors(string $idFileImport): array
    {
        if (empty($idFileImport)) {
            throw new InvalidArgumentException("Parameter 'id_file_import' is required.");
        }

        $body = [
            'id_file_import' => $idFileImport,
        ];

        return $this->connection->request('POST', "reports/product-data-import-file-errors", [
            'body' => $body,
        ]);
    }
}
