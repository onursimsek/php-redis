<?php

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\GenericCommand;

trait GenericCommandObject
{
    final public function commandObject(string $command = GenericCommand::class): CommandObject
    {
        return new CommandObject($command);
    }
}
