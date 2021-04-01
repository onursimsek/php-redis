<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\Auth;
use PhpRedis\Commands\Keys\Sort;

class Version100 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'DECR' => $this->commandObject(),
            'DECRBY' => $this->commandObject(),
            'GET' => $this->commandObject(),
            'GETSET' => $this->commandObject(),
            'INCR' => $this->commandObject(),
            'INCRBY' => $this->commandObject(),
            'MGET' => $this->commandObject(),
            'MSET' => $this->commandObject(),
            'MSETNX' => $this->commandObject(),
            'SET' => $this->commandObject(),
            'SETNX' => $this->commandObject(),

            // Connection commands
            'AUTH' => $this->commandObject(Auth::class),
            'ECHO' => $this->commandObject(),
            'PING' => $this->commandObject(),
            'QUIT' => $this->commandObject(),
            'SELECT' => $this->commandObject(),

            // Set commands
            'SADD' => $this->commandObject(),
            'SCARD' => $this->commandObject(),
            'SDIFF' => $this->commandObject(),
            'SDIFFSTORE' => $this->commandObject(),
            'SINTER' => $this->commandObject(),
            'SINTERSTORE' => $this->commandObject(),
            'SISMEMBER' => $this->commandObject(),
            'SMEMBERS' => $this->commandObject(),
            'SMOVE' => $this->commandObject(),
            'SPOP' => $this->commandObject(),
            'SRANDMEMBER' => $this->commandObject(),
            'SREM' => $this->commandObject(),
            'SUNION' => $this->commandObject(),
            'SUNIONSTORE' => $this->commandObject(),

            // Key commands
            'DEL' => $this->commandObject(),
            'EXISTS' => $this->commandObject(),
            'EXPIRE' => $this->commandObject(),
            'KEYS' => $this->commandObject(),
            'MOVE' => $this->commandObject(),
            'RANDOMKEY' => $this->commandObject(),
            'RENAME' => $this->commandObject(),
            'RENAMENX' => $this->commandObject(),
            'SORT' => $this->commandObject(Sort::class),
            'TTL' => $this->commandObject(),
            'TYPE' => $this->commandObject(),

            // List commands
            'LINDEX' => $this->commandObject(),
            'LLEN' => $this->commandObject(),
            'LPOP' => $this->commandObject(),
            'LPUSH' => $this->commandObject(),
            'LRANGE' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
