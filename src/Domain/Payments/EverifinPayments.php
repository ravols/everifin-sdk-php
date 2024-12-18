<?php

namespace Ravols\EverifinPhp\Domain\Payments;

use GuzzleHttp\Psr7\Request;
use Ravols\EverifinPhp\Config;
use Ravols\EverifinPhp\Domain\Payments\Responses\GetPaymentResponse;
use Ravols\EverifinPhp\Traits\ClientTrait;

class EverifinPayments
{
    use ClientTrait;

    public function getPayment(string $paymentId): GetPaymentResponse
    {
        $guzzleClient = $this->client()->getClient();

        $request = new Request(
            method: 'GET',
            uri: Config::getInstance()->getPaymentEndpoint() . '/' . $paymentId,
            headers: $this->client()->getHeaders(),
        );

        try {
            $response = $guzzleClient->sendRequest($request);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        }

        return GetPaymentResponse::fromResponse($response);
    }
}
