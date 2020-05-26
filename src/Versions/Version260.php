<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientSetName;
use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\Connections\ClientGetName;

class Version260 implements Version
{
    public function addedCommands(): array
    {
        return [
            // String commands
            'BITCOUNT' => [
                'class' => GenericCommand::class,
                'rules' => ['key', 'start', 'end'],
            ],
            'BITOP' => [
                'class' => GenericCommand::class,
                'rules' => ['operation', 'destination_key', 'source_keys'],
            ],
            'INCRBYFLOAT' => [
                'class' => GenericCommand::class,
                'rules' => [
                    'key' => ['required', 'string'],
                    'increment' => ['required', 'float'],
                ],
            ],
            'PSETEX' => [
                'class' => GenericCommand::class,
                'rules' => ['key', 'milliseconds', 'value'],
            ],
            'SET' => [
                'class' => GenericCommand::class,
                'rules' => [
                    'key' => ['required', 'string'],
                    'value' => ['required', 'string'],
                    'expire_type' => ['enum' => ['EX', 'PX']],
                    'expire_time' => ['integer'],
                    'exist' => ['enum' => ['NX', 'XX']],
                ],
            ],
            // Connection commands
            'CLIENTGETNAME' => [
                'class' => ClientGetName::class,
                'rules' => [],
            ],
            'CLIENTSETNAME' => [
                'class' => ClientSetName::class,
                'rules' => [],
            ],
        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}