<?php

namespace Ravols\EverifinPhp\Traits;

use Ravols\EverifinPhp\Clients\Client;

trait ClientTrait
{
    private ?Client $client = null;

    private function client(): Client
    {
        $this->client = $this->client ?? new Client;

        return $this->client;
    }
}
