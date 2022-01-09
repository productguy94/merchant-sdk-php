# Bitsika Console for Merchants - PHP SDK

The Bitsika PHP library gives convenient access to the Console Merchant API for applications written in the PHP language. Devs and merchants alike can use our API and corresponding dashboard to create invoices that any Bitsika user can instantly pay. Learn more here: https://console.bitsika.africa. Our raw API documentation: https://documenter.getpostman.com/view/12690520/UUy39RrV



## General Requirements
1. PHP version 7.0 or greater.
2. Composer for installing packages.
3. The binding relies on [Guzzle](https://guzzle3.readthedocs.io/index.html) to work fine.

## Installation
Install the Bitsika PHP Library. Version to install is `dev-main`.

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

$merchant = new Merchant('PUT_YOUR_SECRET_KEY_HERE');
```

The variable `$merchant` is now an instance of the Merchant class and can be used to perform any of the multiple tasks available to merchants.

# Merchant Methods
### Get merchant detail.

This method returns basic data related to the merchant company whose `Secret Key` you’re currently using. Data returned includes company name, Bitsika username, profile picture URL, KYC status, balances across multiple currencies and much more.

```php
$response = $merchant->detail();

var_dump($response);
```




### Get merchant statistics.
This method returns transaction statistics pertaining to the respective merchant company. It returns data like number of unique users, sum of successful transactions, sum of all transactions, etc.


```php
$response = $merchant->statistics();

var_dump($response);
```

# Invoice Methods

### Create invoice.
This method returns basic data for a newly created invoice including (most importantly) the invoice / payment web link URL. This invoice can we paid by any Bitsika user who opens the payment link. They can pay the invoice with any currency balance in their Bitsika app. You, the merchant, will get settled instantly in the currency you specify when creating the invoice below.

```php
$response = $merchant->invoices()->create([
    "title" => "Vanilla Ice-Cream",
    "description" => "2 scoops of vanilla ice-cream, chocolate biscuits and coconut shavings.",
    "amount" => 2000000,
    "currency" => "NGN",
    "recipient_email" => "test@example.com",
    "photo_url" => "https://image.com/test.jpg"
]);

var_dump($response);
```


| Param | Required | About | Validation |
| :--- | :--- | :--- | :--- |
| title | Yes | Title of the invoice. Here, provide a heading of the service you rendered to your customer. For example "Vanilla ice-cream with coconut shavings". | String. Minimum number of characters = 4. Maximum number of characters = 50. |
| description | Yes | Provide more info on the service your customer is about to pay for. Example: "2 scoops of vanilla ice-cream, chocolate biscuits and coconut shavings. Large cup size". | String. Minimum number of characters = 4. Maximum number of characters = 280. |
| amount | Yes | Amount number that the service costs. | Integer. Minimum amount: 1. Maximum amount: 10000000. It is important to note that because of KYC, fraud control and best practices, we suggest that the amount of your invoice doesn't exceed the equivalent of $1,000 in its respective currency.|
| currency | Yes | Denote the currency you / your company would like the payment of this invoice to be settled in.| Provide one of the following currencies: NGN, USD, XOF, XAF, GHS |
| recipient_email | No | Who should a copy of this invoice be sent to upon creation? | String / Email format. Minimum number of characters = 4. Maximum number of characters = 50. |
| photo_url | No | Provide the URL of your product's / service's item photo.  | String / URL format. Minimum number of characters = 4. Maximum number of characters = 280. |





### Get invoice by id.

This method is used to query an invoice’s data any time in the future. You can use this method to manually check on the state (if it’s been paid or not) or expiry status of an invoice.

```php
$invoiceId = 'INVOICE_ID_HERE';
$response = $merchant->invoices()->get($invoiceId);

var_dump($response);
```




### Send cash.
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
