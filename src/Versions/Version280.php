<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;

class Version280 implements Version
{
    public function addedCommands(): array
    {
        return [
            // String commands
            'BITPOS' => [
                'class' => GenericCommand::class,
                'rules' => ['key', 'bit', 'start', 'end'],
            ],
        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}