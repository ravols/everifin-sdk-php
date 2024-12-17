<?php

use Ravols\EverifinPhp\Config;

function everifinConfig(string $key): mixed
{
    return (new Config)->getConfigValues()[$key];
}
