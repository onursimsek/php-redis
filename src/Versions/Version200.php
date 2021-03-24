<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\GenericCommand;

class Version200 implements Version
{
    public function added(): iterable
    {
        return [
            // String commands
            'APPEND' => new CommandObject(GenericCommand::class),
            'SETEX' => new CommandObject(GenericCommand::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
