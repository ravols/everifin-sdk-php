<?php

namespace Ravols\EverifinPhp\Traits;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Ravols\EverifinPhp\Enums\ResponseMetaStatus;

trait ResponseTrait
{
    public static function validateResponse(ResponseInterface $guzzleResponse): object
    {
        $decodedResponse = json_decode($guzzleResponse->getBody()->getContents());

        if (isset($decodedResponse->errors) && count($decodedResponse->errors)) {
            throw new Exception('There are errors being present in the everifin response. Errors: '.json_encode($decodedResponse->errors));
        }

        if (! isset($decodedResponse->data)) {
            throw new Exception('Response from Everifin does not contain data');
        }

        if (! isset($decodedResponse->meta)) {
            throw new Exception('Response from Everifin does not contain meta data');
        }

        if (isset($decodedResponse->meta) && $decodedResponse->meta->status !== ResponseMetaStatus::SUCCESS->value) {
            throw new Exception('Response from everifin is not Successful. Response: '.json_encode($decodedResponse));
        }

        return $decodedResponse;
    }
}
