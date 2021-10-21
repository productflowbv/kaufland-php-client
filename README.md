![stability-wip](https://img.shields.io/badge/stability-work_in_progress-lightgrey.svg) ![Unit Tests](https://github.com/RemCom/kaufland-php-client/workflows/Unit%20Tests/badge.svg) [![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/RemCom/kaufland-php-client/blob/master/LICENSE) [![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity)

# STILL WORK IN PROGRESS

# kaufland-php-client

An unofficial client for the Kaufland/Real.de API.

## Installation
This project can easily be installed through Composer.

```
composer require remcom/kaufland-php-client
```

## Set-up connection
Prepare the client for connecting to Kaufland with your client key and secret key.
```php
$kaufland = new \RemCom\KauflandPhpClient\Kaufland();
$kaufland->setClientKey($clientkey);
$kaufland->setSecretKey($secretkey);
```

## Get all order-units
Returns an array of order-units
```php
$order_lists = $kaufland->orderUnit()->list();
```

## Supported endpoints (still being added)

:white_check_mark: = Done, and tested
:ballot_box_with_check: = Done, but not yet tested
:x: = Not yet developed

| Endpoint  | Status |
| ------------- | ------------- |
| attributes  | :ballot_box_with_check:  |
| categories  | :ballot_box_with_check:  |
| claim-messages  | :x:  |
| claims  | :x:  |
| import-files  | :x:  |
| items  | :x:  |
| product-data  | :x:  |
| product-data-status  | :x:  |
| orders  | :white_check_mark:  |
| order-invoices  | :ballot_box_with_check:  |
| order-units  | :ballot_box_with_check:  |
| shipments  | :ballot_box_with_check:  |
| reports  | :x:  |
| returns  | :ballot_box_with_check:  |
| return-units  | :ballot_box_with_check:  |
| shipping-groups  | :x:  |
| status  | :x:  |
| subscriptions  | :x:  |
| ticket-messages  | :x:  |
| tickets  | :x:  |
| warehouses  | :x:  |
| units  | :x:  |

