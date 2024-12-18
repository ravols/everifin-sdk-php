<?php

namespace Ravols\EverifinPhp;

class Config
{
    private array $config;
    protected string $client_id;
    protected string $client_secret;
    protected string $client_iban;
    protected string $order_endpoint = 'https://pay.everifin.com/api/v2/orders';
    protected string $order_payment_endpoint = 'https://pay.everifin.com/api/v2/orders/';
    protected string $payment_endpoint = 'https://pay.everifin.com/api/v2/payments';
    protected string $access_token_endpoint = 'https://app.everifin.com/auth/realms/everifin_paygate/protocol/openid-connect/token';

    public function setClientId(string $clientId): void
    {
        $this->client_id = $clientId;
    }

    public function setClientIban(string $clientIban): void
    {
        $this->client_iban = $clientIban;
    }

    public function setClientSecret(string $clientSecret): void
    {
        $this->client_secret = $clientSecret;
    }

    public function getConfigValues(): array
    {
        return $this->config;
    }
}
