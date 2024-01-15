<?php

declare(strict_types=1);

namespace PhpRedis\Commands;

use PhpRedis\Exceptions\PhpRedisException;

class CommandFactory
{
    public static function make(string $commandName, array $arguments = [], string $name = null): Command
    {
        if (! class_exists($commandName)) {
            throw new PhpRedisException(sprintf('The \'%s\' class is not defined', $commandName));
        }

        $command = new $commandName();
        if ($command instanceof AnonymousCommand) {
            if (is_null($name)) {
                throw new PhpRedisException(
                    sprintf('The \'%s\' is an anonymous class. It must have a name', $commandName)
                );
            }
            $command->setCommand($name);
        }

        if ($command instanceof ArgumentativeCommand) {
            $command->setArguments($arguments);
        }

        return $command;
    }
}
