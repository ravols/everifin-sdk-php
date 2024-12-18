<?php

namespace Ravols\EverifinPhp\Domain\Orders;

use GuzzleHttp\Psr7\Request;
use Ravols\EverifinPhp\Domain\Orders\Requests\CreatePaymentRequest;
use Ravols\EverifinPhp\Domain\Orders\Responses\CreatePaymentResponse;
use Ravols\EverifinPhp\Domain\Orders\Responses\GetOrderResponse;
use Ravols\EverifinPhp\Traits\ClientTrait;
use Ravols\EverifinPhp\Traits\ConfigTrait;

class EverifinOrders
{
    use ClientTrait;
    use ConfigTrait;

    public function createOrderPaymentResponse(CreatePaymentRequest $createPaymentRequest): CreatePaymentResponse
    {
        $guzzleClient = $this->client()->getClient();

        $request = new Request(
            method: 'POST',
            uri: everifinConfig(key: 'order_endpoint'),
            headers: $this->client()->getHeaders(),
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
        $guzzleClient = $this->client()->getClient();

        $request = new Request(
            method: 'GET',
            uri: everifinConfig(key: 'order_endpoint') . '/' . $orderId,
            headers: $this->client()->getHeaders()
        );

        try {
            $response = $guzzleClient->sendRequest($request);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        }

        return GetOrderResponse::fromResponse($response);
    }
}
