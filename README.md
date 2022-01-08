# Bitsika Console for Merchants - PHP SDK

The Bitsika PHP library gives convenient access to the Console Merchant API for applications written in the PHP language. Devs and merchants alike can use our API and corresponding dashboard to create invoices that any Bitsika user can instantly pay. Learn more here: https://console.bitsika.africa. Our raw API documentation: https://documenter.getpostman.com/view/12690520/UUy39RrV



## General Requirements
1. PHP version 7.0 or greater.
2. Composer for installing packages.
3. The binding relies on [Guzzle](https://guzzle3.readthedocs.io/index.html) to work fine.

## Installation
Install the Bitsika PHP Library. Version to install is 'dev-main'.

```bash
composer require bitsika/merchant-sdk-php
```

Install the latest version of Guzzle.
```bash
composer require guzzlehttp/guzzle
```

To use the bindings, use Composer's autoload.
```bash
require_once __DIR__ . '/vendor/autoload.php';
```



## Getting Started
To get started, create an instance of the Merchant class. You will need a copy of your Bitsika API `Secret Key`. This can be found on the [Keys and Security page](https://merchant.bitsika.africa/dashboard/merchant/keys-and-security) of our [Console](https://merchant.bitsika.africa/).



```php
require_once __DIR__ . '/vendor/autoload.php';

use Bitsika\Merchant;

$merchant = new Merchant('bsk_sec_SoMemAGicalNumBErForteSt');
```

From the sample above, the variable `$merchant` is now an instance of a Bitsika merchant, and can be used to perform any action on the merchant.

# Merchant
### Get merchant detail
```php
$response = $merchant->detail();

var_dump($response);
```

### Get merchant statistics
```php
$response = $merchant->statistics();

var_dump($response);
```

# Invoices

### Create invoice
```php
$response = $merchant->invoices()->create([
    "title" => "Coins of life",
    "description" => "Biscuits that makes the brain go pita paka, pita paka",
    "amount" => 2000000,
    "currency" => "NGN",
    "recipient_email" => "ibk@bitsika.africa",
    "photo_url" => "https://lindaikeji.com"
]);

var_dump($response);
```

### Get all invoices
```php
$response = $merchant->invoices()->all();

var_dump($response);
```

### Get invoice by id
```php
$invoiceId = '948641e6-b4ea-4053-a60b-7052777f33fa';
$response = $merchant->invoices()->get($invoiceId);

var_dump($response);
```

### Delete invoice
```php
$invoiceId = '948641e6-b4ea-4053-a60b-7052777f33fa';
$response = $merchant->invoices()->delete($invoiceId);

var_dump($response);
```

# Transactions
###  Get all transactions
```php
$response = $merchant->transaction()->all([
    ...
    'type' => 'OUT',
    'mode' => 'BTC',
    ...
]);

var_dump($response);
```
You can add other filters to the array. Alternatively, if you do not plan on filtering your response, you can either leave the array empty or don't pass any argument into it.

###  Get transaction statistics
```php
$response = $merchant->transaction()->statistics();

var_dump($response);
```



### Send Cash
```php
$response = $merchant->transaction()->sendCash([
   "platform" => "Bitsika",
   "amount" => 100,
   "currency" => "USD",
   "username" => "davido",
   "debit_from" => "USD",
   "by_id" => "",
   "for" => ""
]);

var_dump($response);
```
