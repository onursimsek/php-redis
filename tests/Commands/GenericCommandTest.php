<?php

namespace PhpRedis\Tests\Commands;

use PhpRedis\Commands\GenericCommand;
use PHPUnit\Framework\TestCase;

class GenericCommandTest extends TestCase
{
    /**
     * @var GenericCommand
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new GenericCommand();
    }

    public function test_generic_command_can_take_a_name()
    {
        $expected = 'SET';
        $this->command->setCommand('SET');

        self::assertEquals($expected, $this->command->getCommand());
    }

    public function test_generic_command_can_take_arguments()
    {
        $expected = ['key', 'value'];
        $this->command->setArguments(['key', 'value']);

        self::assertEquals($expected, $this->command->getArguments());
    }

    public function test_generic_command_can_be_serialize()
    {
        $expected = "*3\r\n$3\r\nSET\r\n$3\r\nfoo\r\n$3\r\nbar\r\n";
        $this->command->setCommand('SET')
            ->setArguments(['foo', 'bar']);

        self::assertEquals($expected, (string)$this->command);
    }
}