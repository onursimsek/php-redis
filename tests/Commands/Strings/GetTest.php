<?php

namespace PhpRedis\Tests\Commands\Strings;

use PhpRedis\Commands\Strings\Get;
use PHPUnit\Framework\TestCase;

class GetTest extends TestCase
{
    public function test_command()
    {
        $command = $this->getCommand();

        $this->assertEquals('GET', $command->getCommand());
    }

    public function test_arguments()
    {
        $arguments = ['key'];

        $command = $this->getCommand();
        $command->setArguments($arguments);

        $this->assertEquals($arguments, $command->getArguments());
    }

    public function test_serialize()
    {
        $arguments = ['key'];
        $expected = "*2\r\n$3\r\nGET\r\n$3\r\nkey\r\n";

        $command = $this->getCommand();
        $command->setArguments($arguments);

        $this->assertEquals($expected, (string)$command);
    }

    private function getCommand()
    {
        return new Get();
    }
}