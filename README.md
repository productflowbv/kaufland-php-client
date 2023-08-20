![stability-wip](https://img.shields.io/badge/stability-work_in_progress-lightgrey.svg) ![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/productflowbv/kaufland-php-client?include_prereleases) [![MIT License](https://img.shields.io/github/license/productflowbv/kaufland-php-client)](https://github.com/productflowbv/kaufland-php-client/blob/master/LICENSE) [![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity)
# STILL WORK IN PROGRESS

# kaufland-php-client

An unofficial client for the Kaufland/Real.de API.

## Installation
This project can easily be installed through Composer.

```
composer require productflowbv/kaufland-php-client
```

## Set-up connection
Prepare the client for connecting to Kaufland with your client key and secret key.
```php
$kaufland = new \ProductFlow\KauflandPhpClient\Kaufland();
$kaufland->setClientKey($clientkey);
$kaufland->setSecretKey($secretkey);
```

## Get all order-units
Returns an array of order-units
```php
$order_lists = $kaufland->orderUnit()->list();
```

## Supported endpoints (still being added)

:white_check_mark: = Done, and tested<br />
:ballot_box_with_check: = Done, but not yet tested<br />
:x: = Not yet developed<br />
:heavy_exclamation_mark: = deprecated/not supported <br />

| Endpoint  | Status |
| ------------- | ------------- |
| attributes  | :ballot_box_with_check:  |
| categories  | :white_check_mark:  |
| import-files  | :ballot_box_with_check:  |
| items  | :ballot_box_with_check:  |
| product-data  | :white_check_mark:  |
| orders  | :white_check_mark:  |
| order-invoices  | :ballot_box_with_check:  |
| order-units  | :white_check_mark:  |
| shipments  | :ballot_box_with_check:  |
| reports  | :ballot_box_with_check:  |
| returns  | :ballot_box_with_check:  |
| return-units  | :ballot_box_with_check:  |
| shipping-groups  |  :ballot_box_with_check:  |
| status  | :white_check_mark:  |
| subscriptions  | :ballot_box_with_check:  |
| ticket-messages  | :ballot_box_with_check:  |
| tickets  | :ballot_box_with_check:  |
| warehouses  | :ballot_box_with_check:  |
| units  | :white_check_mark:  |

