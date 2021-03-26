<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\Connections\ClientPause;
use PhpRedis\Commands\Connections\ClientReply;
use PhpRedis\Commands\GenericCommand;

class Version320 implements Version
{
    public function added(): iterable
    {
        return [
            // String commands
            'BITFIELD' => new CommandObject(GenericCommand::class),

            // Connection commands
            'CLIENTPAUSE' => new CommandObject(ClientPause::class),
            'CLIENTREPLY' => new CommandObject(ClientReply::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
