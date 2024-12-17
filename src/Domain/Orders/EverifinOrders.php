<?php

namespace Ravols\EverifinPhp\Domain\Orders;

use GuzzleHttp\Psr7\Request;
use Ravols\EverifinPhp\Domain\Orders\Requests\CreatePaymentRequest;
use Ravols\EverifinPhp\Domain\Orders\Responses\CreatePaymentResponse;
use Ravols\EverifinPhp\Domain\Orders\Responses\GetOrderResponse;
use Ravols\EverifinPhp\Traits\ClientTrait;

class EverifinOrders
{
    use ClientTrait;

    public function createOrderPaymentResponse(CreatePaymentRequest $createPaymentRequest): CreatePaymentResponse
    {
        $guzzleClient = $this->getClient()->getClient();

        $request = new Request(
            method: 'POST',
            uri: everifinConfig(key: 'order_endpoint'),
            headers: $this->getClient()->getHeaders(),
            body: $createPaymentRequest->toJson()
        );

        try {
            $response = $guzzleClient->sendRequest($request);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        }

        return CreatePaymentResponse::fromResponse($response);
    }

    public function getOrder(string $orderId): GetOrderResponse
    {
        $guzzleClient = $this->getClient()->getClient();
        $request = new Request(
            method: 'GET',
            uri: everifinConfig(key: 'order_endpoint') . '/' . $orderId,
            headers: $this->getClient()->getHeaders()
        );

        try {
            $response = $guzzleClient->sendRequest($request);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        }

        return GetOrderResponse::fromResponse($response);
    }
}
