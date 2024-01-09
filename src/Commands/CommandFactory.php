<?php

declare(strict_types=1);

namespace PhpRedis\Commands;

use PhpRedis\Exceptions\PhpRedisException;

class CommandFactory
{
    public static function make(CommandObject $commandObject, array $arguments = [], string $name = null): Command
    {
        $class = $commandObject->getClass();
        if (! class_exists($class)) {
            throw new PhpRedisException(sprintf('The \'%s\' class is not defined', $class));
        }

        $command = new $class();
        if ($command instanceof AnonymousCommand) {
            if (is_null($name)) {
                throw new PhpRedisException(sprintf('The \'%s\' is an anonymous class. It must have a name', $class));
            }
            $command->setCommand($name);
        }

        if ($command instanceof ArgumentativeCommand) {
            $command->setArguments($arguments);
        }

        return $command;
    }
}
