<?php

namespace PhpRedis\Tests\Commands\Strings;

use PhpRedis\Commands\Strings\Set;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function test_command()
    {
        $command = new Set();

        $this->assertEquals('SET', $command->getCommand());
    }

    public function test_arguments()
    {
        $arguments = ['key', 'value'];

        $command = new Set();
        $command->setArguments($arguments);

        $this->assertEquals($arguments, $command->getArguments());
    }

    public function test_serialize()
    {
        $arguments = ['key', 'value'];
        $expected = "*3\r\n$3\r\nSET\r\n$3\r\nkey\r\n$5\r\nvalue\r\n";

        $command = new Set();
        $command->setArguments($arguments);

        $this->assertEquals($expected, (string)$command);
    }
}