<?php

namespace PhpRedis\Enums;

enum Protocol: string
{
    case CRLF = "\r\n";
    case SimpleStringFirstByte = '+';
    case BulkStringFirstByte = '$';
    case IntegerFirstByte = ':';
    case ArrayFirstByte = '*';
    case ErrorFirstByte = '-';
    case SuccessResponse = 'OK';
}
