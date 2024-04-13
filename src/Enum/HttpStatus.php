<?php

namespace App\Enum;

enum HttpStatus: int
{

    case OK                     = 200;
    case REDIRECTION            = 300;
    case BAD_REQUEST            = 400;
    case UNAUTHORIZED           = 402;
    case FORBIDDEN              = 403;
    case NOT_FOUND              = 404;
    case METHOD_NOR_ALLOWED     = 405;
    case TIMEOUT                = 408;
    case UNSUPPORTED_MEDIA_TYPE = 415;
    case INTERNAL_SERVER_ERROR  = 500;
    case BAD_GATEWAY            = 502;
    case SERVICE_UNAVAILABLE    = 503;
    case GATEWAY_TIMEOUT        = 504;
}
