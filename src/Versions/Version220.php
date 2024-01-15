<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;

class Version220 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // String commands
            'GETBIT' => GenericCommand::class,
            'SETBIT' => GenericCommand::class,
            'SETRANGE' => GenericCommand::class,
            'STRLEN' => GenericCommand::class,

            // Key commands
            'OBJECT' => GenericCommand::class,
            'PERSIST' => GenericCommand::class,

            // List commands
            'BRPOPLPUSH' => GenericCommand::class,
            'LINSERT' => GenericCommand::class,
            'LPUSHX' => GenericCommand::class,
            'RPUSHX' => GenericCommand::class,

            // Sorted set commands
            'ZREVRANGEBYSCORE' => GenericCommand::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
