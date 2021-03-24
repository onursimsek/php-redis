<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\Connections\ClientGetName;
use PhpRedis\Commands\Connections\ClientSetName;
use PhpRedis\Commands\GenericCommand;

class Version260 implements Version
{
    public function added(): iterable
    {
        return [
            // String commands
            'BITCOUNT' => new CommandObject( GenericCommand::class),
            'BITOP' => new CommandObject( GenericCommand::class),
            'INCRBYFLOAT' => new CommandObject( GenericCommand::class),
            'PSETEX' => new CommandObject( GenericCommand::class),
            'SET' => new CommandObject( GenericCommand::class),

            // Connection commands
            'CLIENTGETNAME' => new CommandObject( ClientGetName::class),
            'CLIENTSETNAME' => new CommandObject( ClientSetName::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}