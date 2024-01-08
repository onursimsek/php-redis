<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientId;
use PHPUnit\Framework\TestCase;

class ClientIdTest extends TestCase
{
    /**
     * @var ClientId
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientId();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT ID', $this->command->getCommand());
    }
}
