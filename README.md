# PHP SDK for Everifin payment gateway
![image](https://github.com/user-attachments/assets/5fa2a114-16fd-4db8-ab5c-e7fb7a834914)

This package is a clean SDK for PHP implementation of Everifin Payment Gateway. By using this package you can create new payments, redirects to gateway and process payments in no time.

## Installation

You can install the package via composer:

```bash
composer require ravols/everifin-sdk-php
```

## Usage

There are multiple modules each representing a domain of services that everifin provides. Let's say you want the most wanted things, which is to create a new order and get a redirect url which will take your customer to Everifin payment gateway, so that you customer can pay for your order.

First of all we need to setup a Config object.
```php
Config::getInstance()->setClientId('your-client-id')->setClientSecret('your-client-secret')->setClientIban('your-recipient-iban');
```
This config needs to be setup only once, as it is accessible as a singleton throughout your application lifecycle.

Lets create new everifin order in order to get our payment redirect url.
```php
$everifinOrderModule = new EverifinOrders; //Represents Everifin Order domain

$createOrderRequest = new CreatePaymentRequest(
    instructionId: '',//if not filled, auto generated by everifin
    amount: 120.99, //float or int
    currency: 'EUR', //Need to be standard currency code
    redirectUrl: 'your-redirect-url', //where customer will land after payment / cancelling the payment on everifin
    recipientIban: Config::getInstance()->getClientIban(),
    senderBankId: 'fkbaredn',
    recipientBankBic: 'uncrskbx',
    variableSymbol: 'variable-symbol', //order number for example, there is a lenght limitation though
    constantSymbol: '0308',
    specificSymbol: '0000000003',
    paymentMessage: 'message-if-you-want',
    externalId: 'ext4123',
    senderEmail:'customer-email',
);

//This response data contain much more than just the link, for this example we are just interested in the redirect link
$createOrderPaymentResponseData = $everifinOrderModule->createOrderPaymentResponse(createPaymentRequest:$createOrderRequest);

$url = $createOrderPaymentResponseData->link;
//Your logic follows with the link - redirect, send via email etc.
```
Great! So now we have our link and let's simulate that we want to process this payment once your customer pays or cancels the payment.
```php
//Depending how you build your Config class you may or may not build it again, for this example we start from scratch
Config::getInstance()->setClientId('your-client-id')->setClientSecret('your-client-secret')->setClientIban('your-recipient-iban');

//Lets get details about the payment
$everifinPayment = new EverifinPayments;

//The order id is send to you as a request GET paramter to the redirect url specified in the redirectUrl parameter when creating an order
$responseData = $everifinPayment->getPayment(paymentId: 'f459c0b7-949e-4266-854d-8f451d5e3c68'); //returns GetPaymentResponse object

$statusOfPayment = $responseData->status; //BOOKED, or other status which can be found in the official everifin docs
//Your logic depending on the status follows here - process order, cancel order etc.
```
List of statuses and more information about everifin API can be found in their [documentation](https://everifin.atlassian.net/wiki/spaces/EPAD/pages/2467561491/Paygate+Payment+Flow)

## Credits

- [Rudolf Bruder](https://github.com/rudolfbruder)
- [Jaroslav Štefanec](https://github.com/jaroslavstefanec)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
