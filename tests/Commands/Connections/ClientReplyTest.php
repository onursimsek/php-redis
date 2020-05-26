<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientReply;
use PHPUnit\Framework\TestCase;

class ClientReplyTest extends TestCase
{
    /**
     * @var ClientReply
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientReply();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT REPLY', $this->command->getCommand());
    }
}