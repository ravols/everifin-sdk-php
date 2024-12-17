<?php

namespace Ravols\EverifinPhp;

class Config
{
    private array $config;

    public function __construct()
    {
        $this->config = include dirname(__DIR__, 1) . '/config/everifin.php';
    }

    public function getConfigValues(): array
    {
        return $this->config;
    }
}
