<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\Connections\ClientKill;
use PhpRedis\Commands\Connections\ClientList;

class Version240 implements Version
{
    public function addedCommands(): array
    {
        return [
            // String commands
            'GETRANGE' => [
                'class' => GenericCommand::class,
                'rules' => [
                    'key' => ['required', 'string'],
                    'start' => ['required', 'integer'],
                    'end' => ['required', 'integer'],
                ],
            ],
            // Connection commands
            'CLIENTKILL' => [
                'class' => ClientKill::class,
                'rules' => [],
            ],
            'CLIENTLIST' => [
                'class' => ClientList::class,
                'rules' => [],
            ],
        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}