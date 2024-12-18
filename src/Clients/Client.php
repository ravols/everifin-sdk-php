<?php

namespace Ravols\EverifinPhp\Clients;

use GuzzleHttp\Client as GuzzleHttpClient;
use Ravols\EverifinPhp\Domain\Common\Responses\GetAccessTokenData;

class Client
{
    protected GuzzleHttpClient $client;

    public function getClient(): GuzzleHttpClient
    {
        $this->client = $this->client ?? (new GuzzleHttpClient);

        return $this->client;
    }

    public function getHeaders(): array
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getToken(),
        ];

        return $headers;
    }

    private function getToken(): string
    {
        $client = new GuzzleHttpClient;
        $options = [
            'form_params' => [
                'client_id' => everifinConfig('client_id'),
                'client_secret' => everifinConfig('client_secret'),
                'grant_type' => 'client_credentials',
            ]];

        $response = $client->post(uri: everifinConfig(key: 'access_token_endpoint'), options: $options);

        $accessTokenResponseData = GetAccessTokenData::fromResponse(guzzleResponse: $response);

        return $accessTokenResponseData->accessToken;
    }
}
