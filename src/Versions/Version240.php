<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\Connections\ClientKill;
use PhpRedis\Commands\Connections\ClientList;
use PhpRedis\Commands\GenericCommand;

class Version240 implements Version
{
    public function added(): iterable
    {
        return [
            // String commands
            'GETRANGE' => new CommandObject( GenericCommand::class),

            // Connection commands
            'CLIENTKILL' => new CommandObject( ClientKill::class),
            'CLIENTLIST' => new CommandObject( ClientList::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}