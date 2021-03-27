<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\Keys\Scan;
use PhpRedis\Commands\Sets\SScan;

class Version280 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'BITPOS' => new CommandObject(GenericCommand::class),

            // Set commands
            'SSCAN' => new CommandObject(SScan::class),

            // Key commands
            'SCAN' => $this->commandObject(Scan::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
