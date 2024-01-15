<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\SortedSets\ZInterStore;

class Version200 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // String commands
            'APPEND' => GenericCommand::class,
            'SETEX' => GenericCommand::class,

            // Hash commands
            'HDEL' => GenericCommand::class,
            'HEXISTS' => GenericCommand::class,
            'HGET' => GenericCommand::class,
            'HGETALL' => GenericCommand::class,
            'HINCRBY' => GenericCommand::class,
            'HKEYS' => GenericCommand::class,
            'HLEN' => GenericCommand::class,
            'HMGET' => GenericCommand::class,
            'HMSET' => GenericCommand::class,
            'HSET' => GenericCommand::class,
            'HSETNX' => GenericCommand::class,
            'HVALS' => GenericCommand::class,

            // List commands
            'BLPOP' => GenericCommand::class,
            'BRPOP' => GenericCommand::class,

            // Sorted set commands
            'ZCOUNT' => GenericCommand::class,
            'ZINTERSTORE' => ZInterStore::class,
            'ZRANK' => GenericCommand::class,
            'ZREMRANGEBYRANK' => GenericCommand::class,
            'ZREVRANK' => GenericCommand::class,
            'ZUNIONSTORE' => GenericCommand::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
