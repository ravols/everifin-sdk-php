<?php

namespace Ravols\EverifinPhp\Domain\Payments;

use GuzzleHttp\Psr7\Request;
use Ravols\EverifinPhp\Clients\Client;
use Ravols\EverifinPhp\Domain\Payments\Responses\GetPaymentResponse;

class EverifinPayments
{
    public function getPayment(string $paymentId): GetPaymentResponse
    {
        $client = new Client;
        $guzzleClient = $client->getClient();
        $request = new Request(
            method: 'GET',
            uri: everifinConfig(key: 'payment_endpoint') . '/' . $paymentId,
            headers: $client->getHeaders(),
        );

        try {
            $response = $guzzleClient->sendRequest($request);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        }

        return GetPaymentResponse::fromResponse($response);
    }
}
