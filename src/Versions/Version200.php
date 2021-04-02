<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

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
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
