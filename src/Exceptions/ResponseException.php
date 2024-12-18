<?php

namespace Ravols\EverifinPhp\Exceptions;

class ResponseException extends \Exception
{
    public static const CODE_ERRORS_IN_RESPONSE = 500;
    public static const CODE_DATA_NOT_PRESENT = 501;
    public static const CODE_META_MISSING = 502;
    public static const CODE_STATUS_NOT_SUCCESSFUL = 503;
}
