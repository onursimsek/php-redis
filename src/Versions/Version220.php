<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\GenericCommand;

class Version220 implements Version
{
    public function added(): iterable
    {
        return [
            // String commands
            'GETBIT' => new CommandObject( GenericCommand::class),
            'SETBIT' => new CommandObject( GenericCommand::class),
            'SETRANGE' => new CommandObject( GenericCommand::class),
            'STRLEN' => new CommandObject( GenericCommand::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}