<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\GenericCommand;

class Version280 implements Version
{
    public function added(): iterable
    {
        return [
            // String commands
            'BITPOS' => new CommandObject(GenericCommand::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
