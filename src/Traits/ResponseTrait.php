<?php

namespace Ravols\EverifinPhp\Traits;

use Psr\Http\Message\ResponseInterface;
use Ravols\EverifinPhp\Enums\ResponseMetaStatus;
use Ravols\EverifinPhp\Exceptions\ResponseException;

trait ResponseTrait
{
    public static function validateResponse(ResponseInterface $guzzleResponse): object
    {
        $decodedResponse = json_decode($guzzleResponse->getBody()->getContents());

        if (isset($decodedResponse->errors) && count($decodedResponse->errors)) {
            throw new ResponseException(message: 'There are errors being present in the everifin response. Errors: ' . json_encode($decodedResponse->errors), code: ResponseException::CODE_ERRORS_IN_RESPONSE);
        }

        if (! isset($decodedResponse->data)) {
            throw new ResponseException(message: 'Response from Everifin does not contain data', code: ResponseException::CODE_DATA_NOT_PRESENT);
        }

        if (! isset($decodedResponse->meta)) {
            throw new ResponseException(message: 'Response from Everifin does not contain meta data', code: ResponseException::CODE_META_MISSING);
        }

        if (isset($decodedResponse->meta) && $decodedResponse->meta->status !== ResponseMetaStatus::SUCCESS->value) {
            throw new ResponseException(message: 'Response from everifin is not Successful. Response: ' . json_encode($decodedResponse), code: ResponseException::CODE_STATUS_NOT_SUCCESSFUL);
        }

        return $decodedResponse;
    }
}
