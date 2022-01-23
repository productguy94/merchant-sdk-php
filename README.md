# Bitsika Console for Merchants - PHP SDK

The Bitsika PHP library gives convenient access to the Console Merchant API for applications written in the PHP language. Devs and merchants alike can use our API and corresponding dashboard to create invoices that any Bitsika user can instantly pay. Learn more here: https://console.bitsika.africa. Our raw API documentation: https://documenter.getpostman.com/view/12690520/UUy39RrV. Small video [demo.](https://www.youtube.com/watch?v=qOBr1cXlV1s)



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


You can also install these packages using the `composer install` command from your `composer.json` file.

```json
{
    "require": {
        "bitsika/merchant-sdk-php": "dev-main",
        "guzzlehttp/guzzle": "7.4.1"
    }
}
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
| amount | Yes | Amount number that the service costs. | Integer. Minimum amount: 1. Maximum amount: 10000000. 2 decimal places, if used. It is important to note that because of KYC, fraud control and best practices, we suggest that the amount of your invoice doesn't exceed the equivalent of $1,000 in its respective currency.|
| currency | Yes | Denote the currency you / your company would like the payment of this invoice to be settled in.| String. Provide one of the following currencies: `NGN`, `USD`, `XOF`, `XAF`, `GHS` |
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

Your merchant company needs to be verified (KYC verification) before you can successfully call this method.

Use this method to send money from your company’s merchant balances to any Bitsika user or merchant with a $username or $cashtag. All such transfers are instant and free.

```php
$response = $merchant->transaction()->sendCash([
   "platform" => "bitsika",
   "amount" => 100,
   "currency" => "USD",
   "username" => "davido",
   "debit_from" => "USD",
   "by_id" => "",
   "for" => ""
]);

var_dump($response);
```




| Param | Required | About | Validation |
| :--- | :--- | :--- | :--- |
| platform | Yes | What network are you transferring the money on? | String. `bitsika` |
| amount | Yes | Numerical value of amount to be transferred. | Integer. Minimum amount: 1. Maximum amount: 10000000. 2 decimal places, if used. It is important to note that because of KYC, fraud control and best practices, we suggest that the amount of your invoice doesn't exceed the equivalent of $1,000 in its respective currency. |
| currency | Yes | Denote the currency you / your company would like the end user to receive the transfer in.| String. Provide one of the following currencies: `NGN`, `USD`, `XOF`, `XAF`, `GHS` |
| username | Yes | Provide the `username` or `cashtag` of the Bitsika user or merchant you're making the transfer to. | String. Example: `davido`, `taylorswift13`. Do not include the `$` infront of the username when writing it. |
| debit_from | Yes | Denote the currency balance you / your company would like the transfer to be deducted from. You can make a transfer in one currency, debited from another. For example: you can send a user 100 USD, but choose to deduct the debit from your NGN balance. | String. Provide one of the following currencies: `NGN`, `USD`, `XOF`, `XAF`, `GHS` |
| purpose | No | A comment or note to accompany the transfer. | String. Minimum number of characters = 4. Maximum number of characters = 255. |


### Verify transaction.

Use this method to verify the status of transfers you make with the `Send Cash` method above.

```php

$transactionId = "YOUR_TRANSACTION_ID_HERE";

$response = $merchant->transaction()->get($transactionId);

var_dump($response);
```




## Invoice Webhooks
Whenever invoices are paid for, events are triggered and notifications are sent to the webhooks you provided on your `keys and security` page. Your webhook url is expected to be an unauthenticated `POST` request url.

Once payments are recieved, weather failed or successful, we make a post request containing the event object to your webhook url.

The request object contains the `event`, `invoice_id` and `transaction` details.

The `event` key will be `invoice.payment_failed` for failed payments, or `invoice.payment_success` for successful payments.

The `invoice_id` is the `id` of the invoice being paid for, while the `transaction` key contains a json object of the payment.

### Verifying webhooks
Everytime a request is made to your webhook url, for security reasons, we also send a `x-bitsika-signature` in the header. This contains a `HMAC SHA512` hash of the payload signed using your secret key.

```php
if($_SERVER['HTTP_X_BITSIKA_SIGNATURE'] !== hash_hmac('sha512', $input, YOUR_SECRET_KEY_HERE))
    exit();
```

**Sample Response -**
An example of the JSON response to expect:
```
{
   "id": 935,
   "reference": "87-1601554148-1530",
   "currency": "USD",
   "status": "Successful",
   "amount": 50,
   "type": "Out",
   "created_at": "2020-10-01 12:09:08",
   "updated_at": "2020-10-01 12:09:08",
   "from_account": {
      "id": 87,
      "name": "Tom Tom Darku",
      "username": "tdlover"
   }
}
```
