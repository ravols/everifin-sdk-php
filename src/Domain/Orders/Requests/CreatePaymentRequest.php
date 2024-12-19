<?php

namespace Ravols\EverifinPhp\Domain\Orders\Requests;

use Ravols\EverifinPhp\Exceptions\RequestException;
use Ravols\EverifinPhp\Helpers\DataHelper\DataHelper;

class CreatePaymentRequest extends DataHelper
{
    public function __construct(
        public float $amount,
        public string $currency,
        public string $redirectUrl,
        public string $recipientIban,
        public ?string $instructionId = null,
        public ?string $senderBankId = null,
        public ?string $recipientBankBic = null,
        public ?string $variableSymbol = null,
        public ?string $constantSymbol = null,
        public ?string $specificSymbol = null,
        public ?string $reference = null,
        public ?string $paymentMessage = null,
        public ?string $recipientName = null,
        public ?float $refundLimitPercentage = null,
        public ?string $preferredBankCountryCode = null,
        public ?string $externalId = null,
        public ?bool $disableHooks = null,
        public ?string $senderEmail = null,
    ) {
        $this->validate();
    }

    public function validate(): void
    {
        if (! is_null($this->variableSymbol) && strlen($this->variableSymbol) > 10) {
            throw new RequestException(message: 'Variable symbol, maximum 10 numeric characters 0-9, not combinable with reference.', code: RequestException::CODE_CREATE_PAYMENT_VARIABLE_SYMBOL);
        }

        if (! is_null($this->constantSymbol) && (strlen($this->constantSymbol) > 4 || ! preg_match('/^\d+$/', $this->constantSymbol))) {
            throw new RequestException(message: 'Constant symbol, maximum 4 numeric characters 0-9, not combinable with reference.', code: RequestException::CODE_CREATE_PAYMENT_CONSTANT_SYMBOL);
        }

        if (! is_null($this->specificSymbol) && strlen($this->specificSymbol) > 10) {
            throw new RequestException(message: 'Specific symbol, maximum 10 numeric characters 0-9, not combinable with reference.', code: RequestException::CODE_CREATE_PAYMENT_SPECIFIC_SYMBOL);
        }

        if (! is_null($this->reference) && strlen($this->reference) > 35) {
            throw new RequestException(message: 'Free text, maximum 35 characters, allowed characters: a-zA-Z0-9/?:().', code: RequestException::CODE_CREATE_PAYMENT_REFERENCE);
        }

        if (! is_null($this->paymentMessage) && strlen($this->paymentMessage) > 140) {
            throw new RequestException(message: 'Free text, maximum 140 characters.', code: RequestException::CODE_CREATE_PAYMENT_PAYMENT_MESSAGE);
        }

        if (! is_null($this->recipientName) && strlen($this->recipientName) > 140) {
            throw new RequestException(message: 'Recipient name can be free text, maximum 140 characters.', code: RequestException::CODE_CREATE_PAYMENT_RECIPIENT_NAME);
        }

        if (! is_null($this->externalId) && strlen($this->externalId) > 255) {
            throw new RequestException(message: 'ExternalId can be free text, maximum 255 characters.', code: RequestException::CODE_CREATE_PAYMENT_EXTERNAL_ID);
        }
    }
}
