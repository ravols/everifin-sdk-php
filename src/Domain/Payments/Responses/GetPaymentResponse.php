<?php

namespace Ravols\EverifinPhp\Domain\Payments\Responses;

use Psr\Http\Message\ResponseInterface;
use Ravols\EverifinPhp\Traits\ResponseTrait;

class GetPaymentResponse
{
    use ResponseTrait;

    public string $id;
    public string $orderId;
    public ?string $instructionId;
    public string $amount;
    public string $currency;
    public string $recipientIban;
    public ?string $senderIban;
    public string $senderBankId;
    public string $senderBankBic;
    public string $variableSymbol;
    public string $constantSymbol;
    public string $specificSymbol;
    public ?string $reference;
    public string $paymentMessage;
    public string $status;
    public string $createdAt;
    public string $confirmedAt;
    public ?string $finalizedAt;
    public string $recipientBankBic;
    public string $recipientName;
    public ?string $hookData;
    public string $disableHooks;

    public static function fromResponse(ResponseInterface $guzzleResponse): self
    {
        $decodedResponse = self::validateResponse(guzzleResponse: $guzzleResponse);
        $responseData = $decodedResponse->data;
        $self = new self;
        $self->id = $responseData->id;
        $self->orderId = $responseData->orderId;
        $self->status = $responseData->status;
        $self->instructionId = $responseData->instructionId;
        $self->amount = $responseData->amount;
        $self->currency = $responseData->currency;
        $self->recipientIban = $responseData->recipientIban;
        $self->senderIban = $responseData->senderIban;
        $self->senderBankId = $responseData->senderBankId;
        $self->senderBankBic = $responseData->senderBankBic;
        $self->variableSymbol = $responseData->variableSymbol;
        $self->constantSymbol = $responseData->constantSymbol;
        $self->specificSymbol = $responseData->specificSymbol;
        $self->reference = $responseData->reference;
        $self->paymentMessage = $responseData->paymentMessage;
        $self->status = $responseData->status;
        $self->createdAt = $responseData->createdAt;
        $self->confirmedAt = $responseData->confirmedAt;
        $self->finalizedAt = $responseData->finalizedAt;
        $self->recipientBankBic = $responseData->recipientBankBic;
        $self->recipientName = $responseData->recipientName;
        $self->hookData = $responseData->hookData;
        $self->disableHooks = $responseData->disableHooks;

        return $self;
    }
}
