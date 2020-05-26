<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientPause;
use PHPUnit\Framework\TestCase;

class ClientPauseTest extends TestCase
{
    /**
     * @var ClientPause
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientPause();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT PAUSE', $this->command->getCommand());
    }
}