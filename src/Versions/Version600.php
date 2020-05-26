<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\Connections\ClientCaching;

class Version600 implements Version
{
    public function addedCommands(): array
    {
        return [
            // String commands
            'SET' => [
                'class' => GenericCommand::class,
                'rules' => [
                    'key' => ['required', 'string'],
                    'value' => ['required', 'string'],
                    'expire_type' => ['enum' => ['EX', 'PX']],
                    'expire_time' => ['integer'],
                    'exist' => ['enum' => ['NX', 'XX']],
                    'keep_ttl' => [],
                ],
            ],
            'STRALGOLCS' => [
                'class' => GenericCommand::class,
                'rules' => [],
            ],
            // Connection commands
            'CLIENTCACHING' => [
                'class' => ClientCaching::class,
                'rules' => [],
            ],
            'CLIENTGETREDIR' => [
                'class' => GenericCommand::class,
                'rules' => [],
            ],
            'CLIENTTRACKING' => [
                'class' => GenericCommand::class,
                'rules' => [],
            ],
            'HELLO' => [
                'class' => GenericCommand::class,
                'rules' => [],
            ],
        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}