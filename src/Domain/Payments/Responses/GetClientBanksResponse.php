<?php

namespace Ravols\EverifinPhp\Domain\Payments\Responses;

use Psr\Http\Message\ResponseInterface;
use Ravols\EverifinPhp\Traits\ResponseTrait;

class GetClientBanksResponse
{
    use ResponseTrait;

    public string $id;

    public string $name;

    public string $countryCode;
    
    public string $countryCodeAlpha2;

    public string $itemType;

    public string $bic;

    public string $logoUrl;


    public static function fromResponse(ResponseInterface $guzzleResponse): array
    {
        $decodedResponse = self::validateResponse(guzzleResponse: $guzzleResponse);
        $responseData = $decodedResponse->data;
        $resultArray = [];

        foreach ($responseData as $data) {
            $self = new self;
            $self->id = $data->id;
            $self->name = $data->name;
            $self->countryCode = $data->countryCode;
            $self->countryCodeAlpha2 = $data->countryCodeAlpha2;
            $self->itemType = $data->itemType;
            $self->bic = $data->bic;
            $self->logoUrl = $data->logoUrl;

            $resultArray[] = $self;
        }
   
        return $resultArray;
    }
}
