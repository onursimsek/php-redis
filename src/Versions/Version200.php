<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;

class Version200 implements Version
{
    public function addedCommands(): array
    {
        return [
            // String commands
            'APPEND' => [
                'class' => GenericCommand::class,
                'rules' => [],
            ],
            'SETEX' => [
                'class' => GenericCommand::class,
                'rules' => ['key', 'seconds', 'value'],
            ],
        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}