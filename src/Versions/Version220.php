<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;

class Version220 implements Version
{
    public function addedCommands(): array
    {
        return [
            // String commands
            'GETBIT' => [
                'class' => GenericCommand::class,
                'rules' => ['key', 'offset'],
            ],
            'SETBIT' => [
                'class' => GenericCommand::class,
                'rules' => ['key', 'offset', 'value'],
            ],
            'SETRANGE' => [
                'class' => GenericCommand::class,
                'rules' => [
                    'key' => ['required', 'string'],
                    'start' => ['required', 'integer'],
                    'value' => ['required', 'string'],
                ],
            ],
            'STRLEN' => [
                'class' => GenericCommand::class,
                'rules' => [
                    'key' => ['required', 'string'],
                ],
            ],
        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}