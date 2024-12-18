<?php

namespace Ravols\EverifinPhp\Exceptions;

class RequestException extends \Exception
{
    public static const CODE_CREATE_PAYMENT_VARIABLE_SYMBOL = 500;
    public static const CODE_CREATE_PAYMENT_CONSTANT_SYMBOL = 501;
    public static const CODE_CREATE_PAYMENT_SPECIFIC_SYMBOL = 502;
    public static const CODE_CREATE_PAYMENT_REFERENCE = 503;
    public static const CODE_CREATE_PAYMENT_PAYMENT_MESSAGE = 504;
    public static const CODE_CREATE_PAYMENT_RECIPIENT_NAME = 505;
    public static const CODE_CREATE_PAYMENT_EXTERNAL_ID = 506;
    public static const CODE_ACCESS_TOKEN_MISSING = 507;
    public static const CODE_NOT_BEARER_TOKEN = 508;
    public static const CODE_ACCESS_TOKEN_EXPIRING = 509;
}
