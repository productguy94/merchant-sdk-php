# Bitsika Merchant SDK

The Bitsika Merchant PHP library gives convenient access to the Merchant API from applications written in the PHP language.

## Requirements
PHP >= 7.0
A Bitsika merchant `secret_key`.
As indicated above, In other to use the package, you need a Bisika Merchant Secret key. If you do not have one, you can get  [here](https://merchant.bitsika.africa/dashboard/merchant/keys-and-security)

## Installation
This package requires PHP >= 7.0 and composer to run.
Run the command below to Install.

```
composer require stripe/stripe-php
```

To use the bindings, use Composer's autoload:
```
require_once __DIR__ . '/vendor/autoload.php';
```

## Dependencies
The binding relies on [Guzzle](https://guzzle3.readthedocs.io/index.html) to work fine

## Getting Started
Below are basic examples on how to use the package.
Here we would assume `bsk_sec_Udb1CPGxNKw7oNP3IwTVfxNP9k8` is our merchant's secret key. (Note: You should change this to your merchant's secret key when testing. If you do not have one, visit [here](https://merchant.bitsika.africa/dashboard/merchant/keys-and-security) to get it)

```
require_once __DIR__ . '/vendor/autoload.php';

use Bitsika\Merchant;

$merchant = new Merchant('bsk_sec_Udb1CPGxNKw7oNP3IwTVfxNP9k8');
```

From the sample above, `$merchant` is now an instance of a Bitsika merchant, and can be used to perform any action on the merchant. 

# Invoices
### Get all invoices
```
$response = $merchant->invoices()->all();

var_dump($response);
```

### Get invoice by id
```
$invoiceId = '948641e6-b4ea-4053-a60b-7052777f33fa';
$response = $merchant->invoices()->get($invoiceId);

var_dump($response);
```

### Delete invoice
```
$invoiceId = '948641e6-b4ea-4053-a60b-7052777f33fa';
$response = $merchant->invoices()->delete($invoiceId);

var_dump($response);
```

### Create invoice
```
$response = $merchant->invoices()->create([
    "title" => "Coins of life", 
    "description" => "Biscuits that makes the brain go pita paka, pita paka", 
    "amount" => "2000000", 
    "currency" => "NGN", 
    "recipient_email" => "ibk@bitsika.africa", 
    "photo_url" => "https://lindaikeji.com" 
]);

var_dump($response);
```

# Transactions
###  Get all transactions
```
$response = $merchant->transaction()->all([
    ...
    'type' => 'OUT',
    'mode' => 'BTC',
    ...
]);

You can add other filters to the array. Or leave the array empty if you do not plan on filtering your response.

var_dump($response);
```

###  Get transaction statistics
```
$response = $merchant->transaction()->statistics();

var_dump($response);
```

### Verify transaction 
```
$transactionId = 591;
$response = $merchant->transaction()->verify($transactionId);

var_dump($response);
```

### Cash out
```
$response = $merchant->transaction()->cashOut([
   "platform" => "Flutterwave", 
   "amount" => 4000, 
   "currency" => "NGN", 
   "debit_from" => "USD", 
   "country" => "Nigeria", 
   "account_name" => "Precious", 
   "bank_code" => "044", 
   "account_number" => "0690000044" 
]);

var_dump($response);
```

### Send Cash
```
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

### Add Cash
```
$response = $merchant->transaction()->addCash([
   "platform" => "Flutterwave", 
   "amount" => 900, 
   "currency" => "USD", 
   "number" => "0556451981", 
   "username" => "akua", 
   "network" => "Vodafone", 
   "address" => "2MysF8fC8qX7BZqRQB9yHa8mYhxW8evzCSc", 
   "account_number" => "0000000000", 
   "account_name" => "Test", 
   "bank_code" => "057", 
   "country" => "Ghana" 
]);

var_dump($response);
```

### Get transaction balances
```
$response = $merchant->transaction()->balances();

var_dump($response);
```

# Virtual card
###  Get all virtual cards
```
$response = $merchant->virtualCard()->all();

var_dump($response);
```

###  Get virtual card by id
```
$cardId = 113;
$response = $merchant->virtualCard()->get($cardId);

var_dump($response);
```

###  Get virtual card by id
```
$cardId = 113;
$response = $merchant->virtualCard()->get($cardId);

var_dump($response);
```

