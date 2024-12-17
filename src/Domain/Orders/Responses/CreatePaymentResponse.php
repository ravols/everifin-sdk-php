<?php

namespace Ravols\EverifinPhp\Domain\Orders\Responses;

use Psr\Http\Message\ResponseInterface;

class CreatePaymentResponse
{
    public string $status;
    public string $id;
    public string $processablePaymentId;
    public string $link;
    public string $paymentStatus;

    public static function fromResponse(ResponseInterface $guzzleResponse): self
    {
        $decodedResponse = json_decode($guzzleResponse->getBody()->getContents());
        $responseData = $decodedResponse->data;
        $self = new self;
        $self->status = $decodedResponse->meta->status;
        $self->id = $responseData->id;
        $self->processablePaymentId = $responseData->processablePaymentId;
        $self->link = $responseData->link;
        $self->paymentStatus = $responseData->status;

        return $self;
    }
}
