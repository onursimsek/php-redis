<?php

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\Auth;
use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\Keys\Sort;

class Version100 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // String commands
            'DECR' => GenericCommand::class,
            'DECRBY' => GenericCommand::class,
            'GET' => GenericCommand::class,
            'GETSET' => GenericCommand::class,
            'INCR' => GenericCommand::class,
            'INCRBY' => GenericCommand::class,
            'MGET' => GenericCommand::class,
            'MSET' => GenericCommand::class,
            'MSETNX' => GenericCommand::class,
            'SET' => GenericCommand::class,
            'SETNX' => GenericCommand::class,

            // Connection commands
            'AUTH' => Auth::class,
            'ECHO' => GenericCommand::class,
            'PING' => GenericCommand::class,
            'QUIT' => GenericCommand::class,
            'SELECT' => GenericCommand::class,

            // Set commands
            'SADD' => GenericCommand::class,
            'SCARD' => GenericCommand::class,
            'SDIFF' => GenericCommand::class,
            'SDIFFSTORE' => GenericCommand::class,
            'SINTER' => GenericCommand::class,
            'SINTERSTORE' => GenericCommand::class,
            'SISMEMBER' => GenericCommand::class,
            'SMEMBERS' => GenericCommand::class,
            'SMOVE' => GenericCommand::class,
            'SPOP' => GenericCommand::class,
            'SRANDMEMBER' => GenericCommand::class,
            'SREM' => GenericCommand::class,
            'SUNION' => GenericCommand::class,
            'SUNIONSTORE' => GenericCommand::class,

            // Key commands
            'DEL' => GenericCommand::class,
            'EXISTS' => GenericCommand::class,
            'EXPIRE' => GenericCommand::class,
            'KEYS' => GenericCommand::class,
            'MOVE' => GenericCommand::class,
            'RANDOMKEY' => GenericCommand::class,
            'RENAME' => GenericCommand::class,
            'RENAMENX' => GenericCommand::class,
            'SORT' => Sort::class,
            'TTL' => GenericCommand::class,
            'TYPE' => GenericCommand::class,

            // List commands
            'LINDEX' => GenericCommand::class,
            'LLEN' => GenericCommand::class,
            'LPOP' => GenericCommand::class,
            'LPUSH' => GenericCommand::class,
            'LRANGE' => GenericCommand::class,
            'LREM' => GenericCommand::class,
            'LSET' => GenericCommand::class,
            'LTRIM' => GenericCommand::class,
            'RPOP' => GenericCommand::class,
            'RPUSH' => GenericCommand::class,

            // Sorted set commands
            'ZRANGEBYSCORE' => GenericCommand::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
