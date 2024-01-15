<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientGetName;
use PhpRedis\Commands\Connections\ClientSetName;
use PhpRedis\Commands\GenericCommand;

class Version260 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // String commands
            'BITCOUNT' => GenericCommand::class,
            'BITOP' => GenericCommand::class,
            'INCRBYFLOAT' => GenericCommand::class,
            'PSETEX' => GenericCommand::class,
            'SET' => GenericCommand::class,

            // Connection commands
            'CLIENTGETNAME' => ClientGetName::class,
            'CLIENTSETNAME' => ClientSetName::class,

            // Key commands
            'DUMP' => GenericCommand::class,
            'PEXPIRE' => GenericCommand::class,
            'PEXPIREAT' => GenericCommand::class,
            'PTTL' => GenericCommand::class,
            'RESTORE' => GenericCommand::class,

            // Hash commands
            'HINCRBYFLOAT' => GenericCommand::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
