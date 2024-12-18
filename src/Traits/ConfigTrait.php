<?php

namespace Ravols\EverifinPhp\Traits;

use Ravols\EverifinPhp\Config;

trait ConfigTrait
{
    private ?Config $config = null;

    private function config(): Config
    {
        $this->config = $this->config ?? $this->buildConfig();

        return $this->config;
    }

    private function buildConfig(): Config
    {
        $config = new Config;
        $config->setClientId(clientId: getenv('EVERIFIN_CLIENT_ID'));
        $config->setClientSecret(clientSecret: getenv('EVERIFIN_CLIENT_SECRET'));
        $config->setClientIban(clientIban: getenv('EVERIFIN_CLIENT_IBAN'));

        return $config;
    }
}
