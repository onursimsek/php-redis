<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\Connections\Auth;
use PhpRedis\Commands\GenericCommand;

class Version100 implements Version
{
    public function added(): iterable
    {
        return [
            // String commands
            'DECR' => new CommandObject( GenericCommand::class),
            'DECRBY' => new CommandObject( GenericCommand::class),
            'GET' => new CommandObject( GenericCommand::class),
            'GETSET' => new CommandObject( GenericCommand::class),
            'INCR' => new CommandObject( GenericCommand::class),
            'INCRBY' => new CommandObject( GenericCommand::class),
            'MGET' => new CommandObject( GenericCommand::class),
            'MSET' => new CommandObject( GenericCommand::class),
            'MSETNX' => new CommandObject( GenericCommand::class),
            'SET' => new CommandObject( GenericCommand::class),
            'SETNX' => new CommandObject( GenericCommand::class),

            // Connection commands
            'AUTH' => new CommandObject( Auth::class),
            'ECHO' => new CommandObject( GenericCommand::class),
            'PING' => new CommandObject( GenericCommand::class),
            'QUIT' => new CommandObject( GenericCommand::class),
            'SELECT' => new CommandObject( GenericCommand::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}