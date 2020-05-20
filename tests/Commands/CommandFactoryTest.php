<?php

namespace PhpRedis\Tests\Commands;

use PhpRedis\Commands\CommandFactory;
use PHPUnit\Framework\TestCase;

class CommandFactoryTest extends TestCase
{
    public function test_make()
    {
        $commandName = 'SET';
        $arguments = ['key', 'value', 'EX', 1000];
        $serialized = "*5\r\n$3\r\nSET\r\n$3\r\nkey\r\n$5\r\nvalue\r\n$2\r\nEX\r\n$4\r\n1000\r\n";
        $command = CommandFactory::make($commandName, $arguments);

        self::assertEquals($commandName, $command->getCommand());
        self::assertEquals($arguments, $command->getArguments());
        self::assertEquals($serialized, (string)$command);
    }
}