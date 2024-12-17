<?php

namespace Ravols\EverifinPhp\Domain\Common\Responses;

class GetAccessTokenData
{
    public function __construct(
        public string $accessToken,
        public int $expiresIn,
        public string $scope,
    ) {}
}
