<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\SortedSets\ZAdd;
use PhpRedis\Commands\SortedSets\ZRevRange;

class Version120 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // Key commands
            'EXPIREAT' => GenericCommand::class,

            // List commands
            'RPOPLPUSH' => GenericCommand::class,

            // Sorted set commands
            'ZADD' => ZAdd::class,
            'ZCARD' => GenericCommand::class,
            'ZINCRBY' => GenericCommand::class,
            'ZRANGE' => GenericCommand::class,
            'ZREM' => GenericCommand::class,
            'ZREMRANGEBYSCORE' => GenericCommand::class,
            'ZREVRANGE' => ZRevRange::class,
            'ZSCORE' => GenericCommand::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
