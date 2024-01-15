<?php

namespace PhpRedis\Tests\Unit\Commands;

use PhpRedis\Commands\GenericCommand;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GenericCommandTest extends TestCase
{
    protected GenericCommand $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new GenericCommand();
    }

    #[Test]
    public function generic_command_can_take_a_name()
    {
        $expected = 'SET';
        $this->command->setCommand('SET');

        self::assertEquals($expected, $this->command->getCommand());
    }

    #[Test]
    public function generic_command_can_take_arguments()
    {
        $expected = ['key', 'value'];
        $this->command->setArguments(['key', 'value']);

        self::assertEquals($expected, $this->command->getArguments());
    }

    #[Test]
    public function generic_command_can_be_serialize()
    {
        $expected = "*3\r\n$3\r\nSET\r\n$3\r\nfoo\r\n$3\r\nbar\r\n";
        $this->command->setCommand('SET')
            ->setArguments(['foo', 'bar']);

        self::assertEquals($expected, (string)$this->command);
    }
}
