<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientPause;
use PhpRedis\Commands\Connections\ClientReply;
use PhpRedis\Commands\GenericCommand;

class Version320 implements Version
{
    public function addedCommands(): array
    {
        return [
            // String commands
            'BITFIELD' => [
                'class' => GenericCommand::class,
                'rules' => [],
            ],
            // Connection commands
            'CLIENTPAUSE' => [
                'class' => ClientPause::class,
                'rules' => [],
            ],
            'CLIENTREPLY' => [
                'class' => ClientReply::class,
                'rules' => [],
            ],
        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}