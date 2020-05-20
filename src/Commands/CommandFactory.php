<?php

declare(strict_types=1);

namespace PhpRedis\Commands;

use PhpRedis\Traits\AnonymousCommand;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;

class CommandFactory
{
    public static function make(string $name, array $arguments): Command
    {
        return (new class implements Command {
            use AnonymousCommand;
            use HasArguments;
            use Stringify;
        })->setCommand($name)
            ->setArguments($arguments);
    }
}