<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientUnblock;
use PHPUnit\Framework\TestCase;

class ClientUnblockTest extends TestCase
{
    /**
     * @var ClientUnblock
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientUnblock();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT UNBLOCK', $this->command->getCommand());
    }
}
