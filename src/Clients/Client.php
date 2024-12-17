<?php

namespace Ravols\EverifinPhp\Clients;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Psr7\Request;
use Ravols\EverifinPhp\Domain\Common\Responses\GetAccessTokenData;

class Client
{
    private const ACCESS_TOKEN_URL = 'https://app.everifin.com/auth/realms/everifin_paygate/protocol/openid-connect/token';

    protected GuzzleHttpClient $client;

    public function getClient(): GuzzleHttpClient
    {
        $this->client = $this->client ?? $this->buildClient();

        return $this->client;
    }

    private function buildClient(): GuzzleHttpClient
    {
        $client = new GuzzleHttpClient;

        return $client;
    }

    public function getHeaders(): array
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$this->getToken(),
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
        $request = new Request('POST', self::ACCESS_TOKEN_URL);
        $res = $client->sendAsync($request, $options)->wait();
        $decodedResponse = json_decode($res->getBody()->getContents());
        $accessTokenResponseData = new GetAccessTokenData(
            accessToken: $decodedResponse->access_token,
            expiresIn: (int) $decodedResponse->access_token,
            scope: $decodedResponse->scope
        );

        return $accessTokenResponseData->accessToken;
    }
}
