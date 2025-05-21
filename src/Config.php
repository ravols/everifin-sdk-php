<?php

namespace Ravols\EverifinPhp;

class Config
{
    private static $instance = null;

    private function __construct() {}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Config;
        }

        return self::$instance;
    }

    protected string $client_id;
    protected string $client_secret;
    protected string $client_iban;
    protected string $order_endpoint = 'https://pay.everifin.com/api/v2/orders';
    protected string $order_payment_endpoint = 'https://pay.everifin.com/api/v2/orders/';
    protected string $payment_endpoint = 'https://pay.everifin.com/api/v2/payments';
    protected string $access_token_endpoint = 'https://app.everifin.com/auth/realms/everifin_paygate/protocol/openid-connect/token';
    protected string $client_banks_endpoint = 'https://pay.everifin.com/api/v2/banks';

    public function setClientId(string $clientId): self
    {
        $this->client_id = $clientId;

        return $this;
    }

    public function setClientIban(string $clientIban): self
    {
        $this->client_iban = $clientIban;

        return $this;
    }

    public function setClientSecret(string $clientSecret): self
    {
        $this->client_secret = $clientSecret;

        return $this;
    }

    public function getOrderEndpoint(): string
    {
        return $this->order_endpoint;
    }

    public function getClientId(): string
    {
        return $this->client_id;
    }

    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    public function getClientIban(): string
    {
        return $this->client_iban;
    }

    public function getAccessTokenEndpoint(): string
    {
        return $this->access_token_endpoint;
    }

    public function getPaymentEndpoint(): string
    {
        return $this->payment_endpoint;
    }

    public function getClientBanksEndpoint(): string
    {
        return $this->client_banks_endpoint;
    }
}
