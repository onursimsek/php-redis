<?php

namespace PhpRedis\Tests\Commands;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\GenericCommand;
use PHPUnit\Framework\TestCase;

class CommandObjectTest extends TestCase
{
    public function test_should_be_set_command_class()
    {
        $commandObject = new CommandObject(GenericCommand::class);

        self::assertEquals(GenericCommand::class, $commandObject->getClass());
    }

    public function test_can_be_set_command_class()
    {
        $rules = ['key' => ['required', 'string'], 'value' => ['required', 'integer']];
        $expected = ['key' => ['required', 'string'], 'value' => ['required', 'integer']];

        $commandObject = new CommandObject(GenericCommand::class, $rules);

        self::assertEquals($expected, $commandObject->getRules());
    }
}
