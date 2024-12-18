<?php

namespace Ravols\EverifinPhp\Domain\Common\Responses;

use Psr\Http\Message\ResponseInterface;
use Ravols\EverifinPhp\Exceptions\RequestException;

class GetAccessTokenData
{
    public string $accessToken;
    public int $expiresIn;
    public string $scope;

    private const ACCESS_TOKEN_EXPIRES_THRESHOLD = 10;

    public static function fromResponse(ResponseInterface $guzzleResponse): self
    {
        $decodedResponse = json_decode($guzzleResponse->getBody()->getContents());
        self::validateResponse(decodedResponse: $decodedResponse);
        $self = new self;
        $self->accessToken = $decodedResponse->access_token;
        $self->expiresIn = $decodedResponse->expires_in;
        $self->scope = $decodedResponse->scope;

        return $self;
    }

    private static function validateResponse(object $decodedResponse): void
    {
        if (! isset($decodedResponse->access_token)) {
            throw new RequestException(message: 'Access token not present in the response', code: RequestException::CODE_ACCESS_TOKEN_MISSING);
        }

        if (! isset($decodedResponse->token_type) && $decodedResponse->token_type !== 'Bearer') {
            throw new RequestException(message: 'Access token in response is not Bearer token type', code: RequestException::CODE_NOT_BEARER_TOKEN);
        }

        if (! isset($decodedResponse->expires_in) && $decodedResponse->expires_in < self::ACCESS_TOKEN_EXPIRES_THRESHOLD) {
            throw new RequestException(message: 'Access token expires in less than 10 seconds.', code: RequestException::CODE_ACCESS_TOKEN_EXPIRING);
        }
    }
}
