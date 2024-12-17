<?php

namespace Ravols\EverifinPhp\Domain\Orders\Responses;

use Psr\Http\Message\ResponseInterface;
use Ravols\EverifinPhp\Traits\ResponseTrait;

class GetOrderResponse
{
    use ResponseTrait;

    public string $id;

    public float $amount;

    public string $currency;

    public string $refundLimitPercentage;

    public string $recipientIban;

    public string $recipientName;

    public string $recipientBankBic;

    public string $status;

    public string $externalId;

    public string $canBeWithdrawn;

    public string $canBeUpdated;

    public string $sumOfPaid;

    public string $sumOfRefunded;

    public string $createdAt;

    public array $payments = [];

    public array $refunds = [];

    public static function fromResponse(ResponseInterface $guzzleResponse): self
    {
        $decodedResponse = self::validateResponse(guzzleResponse: $guzzleResponse);
        $responseData = $decodedResponse->data;
        $self = new self;
        $self->id = $responseData->id;
        $self->amount = $responseData->amount;
        $self->currency = $responseData->currency;
        $self->refundLimitPercentage = $responseData->refundLimitPercentage;
        $self->recipientIban = $responseData->recipientIban;
        $self->recipientName = $responseData->recipientName;
        $self->recipientBankBic = $responseData->recipientBankBic;
        $self->status = $responseData->status;
        $self->externalId = $responseData->externalId;
        $self->canBeWithdrawn = $responseData->canBeWithdrawn;
        $self->canBeUpdated = $responseData->canBeUpdated;
        $self->sumOfPaid = $responseData->sumOfPaid;
        $self->sumOfRefunded = $responseData->sumOfRefunded;
        $self->createdAt = $responseData->createdAt;

        if (isset($responseData->payments)) {
            $payments = [];
            foreach ($responseData->payments as $payment) {
                $payments[] = $payment;
            }

            $self->payments = $payments;
        }

        if (isset($responseData->refunds)) {
            $refunds = [];
            foreach ($responseData->refunds as $payment) {
                $refunds[] = $payment;
            }

            $self->refunds = $refunds;
        }

        return $self;
    }
}
