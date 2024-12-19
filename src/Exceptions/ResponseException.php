<?php

namespace Ravols\EverifinPhp\Exceptions;

class ResponseException extends \Exception
{
    public const CODE_ERRORS_IN_RESPONSE = 500;
    public const CODE_DATA_NOT_PRESENT = 501;
    public const CODE_META_MISSING = 502;
    public const CODE_STATUS_NOT_SUCCESSFUL = 503;

    public array $errors = [];

    public function __construct($message, $code, $errors = [])
    {
        $this->errors = $errors;
        parent::__construct($message, $code);
    }
}
