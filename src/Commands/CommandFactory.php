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
            throw new PhpRedisException("The '{$class}' class is not defined");
        }

        $command = new $class();
        if ($command instanceof AnonymousCommand) {
            if (is_null($name)) {
                throw new PhpRedisException("The '{$class}' is an anonymous class. It must have a name");
            }
            $command->setCommand($name);
        }

        if ($command instanceof ArgumentativeCommand) {
            $command->setArguments($arguments);
        }

        return $command;
    }
}
