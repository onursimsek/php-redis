<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientGetRedirecting;
use PHPUnit\Framework\TestCase;

class ClientGetRedirectingTest extends TestCase
{
    /**
     * @var ClientGetRedirecting
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientGetRedirecting();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT GETREDIR', $this->command->getCommand());
    }
}
