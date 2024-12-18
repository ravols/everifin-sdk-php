<?php

namespace Ravols\EverifinPhp\Clients;

use GuzzleHttp\Client as GuzzleHttpClient;
use Ravols\EverifinPhp\Config;
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
                'client_id' => Config::getInstance()->getClientId(),
                'client_secret' => Config::getInstance()->getClientSecret(),
                'grant_type' => 'client_credentials',
            ]];

        $response = $client->post(uri: Config::getInstance()->getAccessTokenEndpoint(), options: $options);

        $accessTokenResponseData = GetAccessTokenData::fromResponse(guzzleResponse: $response);

        return $accessTokenResponseData->accessToken;
    }
}
