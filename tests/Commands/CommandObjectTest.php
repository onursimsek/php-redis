<?php

namespace PhpRedis\Tests\Commands;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\GenericCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(CommandObject::class)]
class CommandObjectTest extends TestCase
{
    #[Test]
    public function should_be_set_command_class()
    {
        $commandObject = new CommandObject(GenericCommand::class);

        self::assertEquals(GenericCommand::class, $commandObject->getClass());
    }

    #[Test]
    public function can_be_set_command_class()
    {
        $rules = ['key' => ['required', 'string'], 'value' => ['required', 'integer']];
        $expected = ['key' => ['required', 'string'], 'value' => ['required', 'integer']];

        $commandObject = new CommandObject(GenericCommand::class, $rules);

        self::assertEquals($expected, $commandObject->getRules());
    }
}
