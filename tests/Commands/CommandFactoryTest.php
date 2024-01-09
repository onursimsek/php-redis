<?php

namespace PhpRedis\Tests\Commands;

use PhpRedis\Commands\CommandFactory;
use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\Connections\ClientId;
use PhpRedis\Commands\GenericCommand;
use PhpRedis\Exceptions\PhpRedisException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(CommandFactory::class)]
class CommandFactoryTest extends TestCase
{
    #[Test]
    public function can_be_make_a_command()
    {
        $class = $this->getMockBuilder(CommandObject::class)->disableOriginalConstructor()->getMock();
        $class->expects($this->once())
            ->method('getClass')
            ->willReturn(GenericCommand::class);

        $commandName = 'SET';
        $arguments = ['key', 'value', 'EX', 1000];
        $serialized = "*5\r\n$3\r\nSET\r\n$3\r\nkey\r\n$5\r\nvalue\r\n$2\r\nEX\r\n$4\r\n1000\r\n";
        $command = CommandFactory::make($class, $arguments, $commandName);

        self::assertEquals($commandName, $command->getCommand());
        self::assertEquals($arguments, $command->getArguments());
        self::assertEquals($serialized, (string)$command);

        $class = $this->getMockBuilder(CommandObject::class)->disableOriginalConstructor()->getMock();
        $class->expects($this->once())
            ->method('getClass')
            ->willReturn(ClientId::class);

        $commandName = 'CLIENT ID';
        $serialized = "*2\r\n$6\r\nCLIENT\r\n$2\r\nID\r\n";
        $command = CommandFactory::make($class);

        self::assertEquals($commandName, $command->getCommand());
        self::assertEquals($serialized, (string)$command);
    }

    #[Test]
    public function should_not_make_a_command_with_dont_exists_class()
    {
        $namespace = '\There\Is\Not\A\Class';
        $class = $this->getMockBuilder(CommandObject::class)->disableOriginalConstructor()->getMock();
        $class->expects($this->once())
            ->method('getClass')
            ->willReturn($namespace);

        self::expectException(PhpRedisException::class);
        self::expectExceptionMessage("The '{$namespace}' class is not defined");

        CommandFactory::make($class);
    }

    #[Test]
    public function should_not_be_make_a_command_without_name_when_generic_command()
    {
        $namespace = GenericCommand::class;
        $class = $this->getMockBuilder(CommandObject::class)->disableOriginalConstructor()->getMock();
        $class->expects($this->once())
            ->method('getClass')
            ->willReturn($namespace);

        self::expectException(PhpRedisException::class);
        self::expectExceptionMessage("The '{$namespace}' is an anonymous class. It must have a name");

        CommandFactory::make($class);
    }
}
