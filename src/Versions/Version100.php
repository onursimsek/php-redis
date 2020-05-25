<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\Connections\Auth;

class Version100 implements Version
{
    public function addedCommands(): array
    {
        return [
            // String commands
            'DECR' => [
                'class' => GenericCommand::class,
                'rules' => ['key' => ['required', 'string'],],
            ],
            'DECRBY' => [
                'class' => GenericCommand::class,
                'rules' => [
                    'key' => ['required', 'string'],
                    'decriment' => ['required', 'integer'],
                ],
            ],
            'GET' => [
                'class' => GenericCommand::class,
                'rules' => ['key' => ['required', 'string'],],
            ],
            'GETSET' => [
                'class' => GenericCommand::class,
                'rules' => ['key', 'value'],
            ],
            'INCR' => [
                'class' => GenericCommand::class,
                'rules' => [
                    'key' => ['required', 'string'],
                ],
            ],
            'INCRBY' => [
                'class' => GenericCommand::class,
                'rules' => [
                    'key' => ['required', 'string'],
                    'increment' => ['required', 'integer'],
                ],
            ],
            'MGET' => [
                'class' => GenericCommand::class,
                'rules' => [
                    '*' => ['required', 'string'],
                ],
            ],
            'MSET' => [
                'class' => GenericCommand::class,
                'rules' => [
                    '*' => ['required', 'array'],
                ],
            ],
            'MSETNX' => [
                'class' => GenericCommand::class,
                'rules' => ['key', 'value'],
            ],
            'SET' => [
                'class' => GenericCommand::class,
                'rules' => [
                    'key' => ['required', 'string'],
                    'value' => ['required', 'string'],
                ],
            ],
            'SETNX' => [
                'class' => GenericCommand::class,
                'rules' => ['key', 'value'],
            ],
            // Connection commands
            'AUTH' => [
                'class' => Auth::class,
                'rules' => [],
            ],
            'ECHO' => [
                'class' => GenericCommand::class,
                'rules' => [],
            ],
            'PING' => [
                'class' => GenericCommand::class,
                'rules' => [],
            ],
            'QUIT' => [
                'class' => GenericCommand::class,
                'rules' => [],
            ],
            'SELECT' => [
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