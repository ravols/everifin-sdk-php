<?php

namespace Ravols\EverifinPhp\Domain\Payments;

use GuzzleHttp\Psr7\Request;
use Ravols\EverifinPhp\Domain\Payments\Responses\GetPaymentResponse;
use Ravols\EverifinPhp\Traits\ClientTrait;

class EverifinPayments
{
    use ClientTrait;

    public function getPayment(string $paymentId): GetPaymentResponse
    {
        $guzzleClient = $this->getClient()->getClient();

        $request = new Request(
            method: 'GET',
            uri: everifinConfig(key: 'payment_endpoint') . '/' . $paymentId,
            headers: $this->getClient()->getHeaders(),
        );

        try {
            $response = $guzzleClient->sendRequest($request);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        }

        return GetPaymentResponse::fromResponse($response);
    }
}
