<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\Connections\ClientCaching;
use PhpRedis\Commands\Connections\ClientGetRedirecting;
use PhpRedis\Commands\GenericCommand;

class Version600 implements Version
{
    public function added(): iterable
    {
        return [
            // String commands
            'SET' => new CommandObject(GenericCommand::class),
            'STRALGOLCS' => new CommandObject(GenericCommand::class),

            // Connection commands
            'CLIENTCACHING' => new CommandObject(ClientCaching::class),
            'CLIENTGETREDIR' => new CommandObject(ClientGetRedirecting::class),
            'CLIENTTRACKING' => new CommandObject(GenericCommand::class),
            'HELLO' => new CommandObject(GenericCommand::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
