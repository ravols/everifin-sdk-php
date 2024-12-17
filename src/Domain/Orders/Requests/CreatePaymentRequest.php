<?php

namespace Ravols\EverifinPhp\Domain\Orders\Requests;

class CreatePaymentRequest
{
    public function __construct(
        public ?string $instructionId,
        public float $amount,
        public string $currency,
        public string $redirectUrl,
        public string $recipientIban,
        public string $senderBankId,
        public string $recipientBankBic,
        public string $variableSymbol,
        public string $constantSymbol,
        public string $specificSymbol,
        public string $paymentMessage,
        public string $externalId,
        public string $senderEmail,
    ) {}

    public function toJson(): string
    {
        return json_encode($this);
    }
}
