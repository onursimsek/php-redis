<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientSetName;
use PHPUnit\Framework\TestCase;

class ClientSetNameTest extends TestCase
{
    /**
     * @var ClientSetName
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientSetName();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT SETNAME', $this->command->getCommand());
    }
}
