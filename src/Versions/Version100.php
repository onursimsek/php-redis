<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\Connections\Auth;
use PhpRedis\Commands\GenericCommand;

class Version100 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'DECR' => new CommandObject(GenericCommand::class),
            'DECRBY' => new CommandObject(GenericCommand::class),
            'GET' => new CommandObject(GenericCommand::class),
            'GETSET' => new CommandObject(GenericCommand::class),
            'INCR' => new CommandObject(GenericCommand::class),
            'INCRBY' => new CommandObject(GenericCommand::class),
            'MGET' => new CommandObject(GenericCommand::class),
            'MSET' => new CommandObject(GenericCommand::class),
            'MSETNX' => new CommandObject(GenericCommand::class),
            'SET' => new CommandObject(GenericCommand::class),
            'SETNX' => new CommandObject(GenericCommand::class),

            // Connection commands
            'AUTH' => new CommandObject(Auth::class),
            'ECHO' => new CommandObject(GenericCommand::class),
            'PING' => new CommandObject(GenericCommand::class),
            'QUIT' => new CommandObject(GenericCommand::class),
            'SELECT' => new CommandObject(GenericCommand::class),

            // Set commands
            'SADD' => new CommandObject(GenericCommand::class),
            'SCARD' => new CommandObject(GenericCommand::class),
            'SDIFF' => new CommandObject(GenericCommand::class),
            'SDIFFSTORE' => new CommandObject(GenericCommand::class),
            'SINTER' => new CommandObject(GenericCommand::class),
            'SINTERSTORE' => new CommandObject(GenericCommand::class),
            'SISMEMBER' => new CommandObject(GenericCommand::class),
            'SMEMBERS' => new CommandObject(GenericCommand::class),
            'SMOVE' => new CommandObject(GenericCommand::class),
            'SPOP' => new CommandObject(GenericCommand::class),
            'SRANDMEMBER' => new CommandObject(GenericCommand::class),
            'SREM' => new CommandObject(GenericCommand::class),
            'SUNION' => new CommandObject(GenericCommand::class),
            'SUNIONSTORE' => new CommandObject(GenericCommand::class),

            // Key commands
            'DEL' => new CommandObject(GenericCommand::class),
            'EXISTS' => $this->commandObject(),
            'EXPIRE' => $this->commandObject(),
            'KEYS' => $this->commandObject(),
            'MOVE' => $this->commandObject(),
            'RANDOMKEY' => $this->commandObject(),
            'RENAME' => $this->commandObject(),
            'RENAMENX' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
