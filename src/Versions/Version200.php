<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\SortedSets\ZInterStore;

class Version200 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'APPEND' => $this->commandObject(),
            'SETEX' => $this->commandObject(),

            // Hash commands
            'HDEL' => $this->commandObject(),
            'HEXISTS' => $this->commandObject(),
            'HGET' => $this->commandObject(),
            'HGETALL' => $this->commandObject(),
            'HINCRBY' => $this->commandObject(),
            'HKEYS' => $this->commandObject(),
            'HLEN' => $this->commandObject(),
            'HMGET' => $this->commandObject(),
            'HMSET' => $this->commandObject(),
            'HSET' => $this->commandObject(),
            'HSETNX' => $this->commandObject(),
            'HVALS' => $this->commandObject(),

            // List commands
            'BLPOP' => $this->commandObject(),
            'BRPOP' => $this->commandObject(),

            // Sorted set commands
            'ZCOUNT' => $this->commandObject(),
            'ZINTERSTORE' => $this->commandObject(ZInterStore::class),
            'ZRANK' => $this->commandObject(),
            'ZREMRANGEBYRANK' => $this->commandObject(),
            'ZREVRANK' => $this->commandObject(),
            'ZUNIONSTORE' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
