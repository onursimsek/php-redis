<?php

declare(strict_types=1);

namespace PhpRedis\Exceptions;

use Throwable;

class RespException extends PhpRedisException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = explode(' ', $message, 2)[1] ?? 'Error message could not be read';
        parent::__construct($message, $code, $previous);
    }
}