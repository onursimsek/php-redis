<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

interface Protocol
{
    public const CRLF = "\r\n";

    public const SIMPLE_STRING_FIRST_BYTE = '+';
    public const BULK_STRING_FIRST_BYTE = '$';
    public const INTEGER_FIRST_BYTE = ':';
    public const ARRAY_FIRST_BYTE = '*';
    public const ERROR_FIRST_BYTE = '-';

    public const SUCCESS_RESPONSE = 'OK';
}
