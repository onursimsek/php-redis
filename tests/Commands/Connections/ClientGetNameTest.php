<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientGetName;
use PHPUnit\Framework\TestCase;

class ClientGetNameTest extends TestCase
{
    /**
     * @var ClientGetName
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientGetName();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT GETNAME', $this->command->getCommand());
    }
}
