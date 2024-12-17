<?php

namespace Ravols\EverifinPhp\Domain\Orders;

use GuzzleHttp\Psr7\Request;
use Ravols\EverifinPhp\Clients\Client;
use Ravols\EverifinPhp\Domain\Orders\Requests\CreatePaymentRequest;
use Ravols\EverifinPhp\Domain\Orders\Responses\CreatePaymentResponse;

class EverifinOrders
{
    public function createOrderPaymentResponse(CreatePaymentRequest $createPaymentRequest): CreatePaymentResponse
    {
        $client = new Client;
        $guzzleClient = $client->getClient();
        $request = new Request(
            method: 'POST',
            uri: everifinConfig(key: 'order_endpoint'),
            headers: $client->getHeaders(),
            body: $createPaymentRequest->toJson()
        );

        try {
            $response = $guzzleClient->sendRequest($request);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        }

        return CreatePaymentResponse::fromResponse($response);
    }
}
