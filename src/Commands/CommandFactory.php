<?php

declare(strict_types=1);

namespace PhpRedis\Commands;

use PhpRedis\Exceptions\PhpRedisException;

class CommandFactory
{
    public static function make(string $class, array $arguments = [], string $name = null): Command
    {
        if (!class_exists($class)) {
            throw new PhpRedisException("The '{$class}' class is not defined");
        }

        $command = new $class();
        if ($command instanceof AnonymousCommand) {
            if (is_null($name)) {
                throw new PhpRedisException("The '{$class}' is anonymous class. It must have a name");
            }
            $command->setCommand($name);
        }

        if ($command instanceof ArgumentativeCommand) {
            $command->setArguments($arguments);
        }

        return $command;
    }
}