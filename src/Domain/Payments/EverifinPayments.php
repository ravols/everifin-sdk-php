<?php

namespace Ravols\EverifinPhp\Domain\Payments;

use GuzzleHttp\Psr7\Request;
use Ravols\EverifinPhp\Config;
use Ravols\EverifinPhp\Domain\Payments\Responses\GetPaymentResponse;
use Ravols\EverifinPhp\Domain\Payments\Responses\GetClientBanksResponse;
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

    public function getClientBanks(?string $countryCode): array
    {
        $guzzleClient = $this->client()->getClient();

        $uri = Config::getInstance()->getClientBanksEndpoint();

        if(! is_null($countryCode)){
            $uri .= '?countryCode=' . $countryCode;
        }

        $request = new Request(
            method: 'GET',
            uri: $uri,
            headers: $this->client()->getHeaders()
        );

        try {
            $response = $guzzleClient->sendRequest($request);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw $e;
        }

        return GetClientBanksResponse::fromResponse($response);
    }
}
