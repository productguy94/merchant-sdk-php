# Bitsika Console for Merchants - PHP SDK

The Bitsika PHP library gives convenient access to the Console Merchant API for applications written in the PHP language. Devs and merchants alike can use our API and corresponding dashboard to create invoices that any Bitsika user can instantly pay. Learn more here: https://console.bitsika.africa 

## API Documentation
https://documenter.getpostman.com/view/12690520/UUy39RrV

## Requirements
- PHP >= 7.0
- A Bitsika merchant `secret_key`.
>> As indicated above, In other to use the package, you need a Bisika Merchant Secret key. If you do not have one, you can get  [here](https://merchant.bitsika.africa/dashboard/merchant/keys-and-security)

## Installation
This package requires PHP >= 7.0 and composer to run.
Run the command below to Install.

```bash
composer require bitsika/merchant-sdk-php
```

To use the bindings, use Composer's autoload:
```bash
require_once __DIR__ . '/vendor/autoload.php';
```

## Dependencies
The binding relies on [Guzzle](https://guzzle3.readthedocs.io/index.html) to work fine

## Getting Started
Below are basic examples on how to use the package.
>> Here we would assume `bsk_sec_SoMemAGicalNumBErForteSt` is our merchant's secret key. (Note: You should change this to your merchant's secret key when testing. If you do not have one, visit [here](https://merchant.bitsika.africa/dashboard/merchant/keys-and-security) to get it)


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
