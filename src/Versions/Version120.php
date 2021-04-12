<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\SortedSets\ZAdd;
use PhpRedis\Commands\SortedSets\ZRevRange;

class Version120 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // Key commands
            'EXPIREAT' => $this->commandObject(),

            // List commands
            'RPOPLPUSH' => $this->commandObject(),

            // Sorted set commands
            'ZADD' => $this->commandObject(ZAdd::class),
            'ZCARD' => $this->commandObject(),
            'ZINCRBY' => $this->commandObject(),
            'ZRANGE' => $this->commandObject(),
            'ZREM' => $this->commandObject(),
            'ZREMRANGEBYSCORE' => $this->commandObject(),
            'ZREVRANGE' => $this->commandObject(ZRevRange::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
