<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientKill;
use PHPUnit\Framework\TestCase;

class ClientKillTest extends TestCase
{
    /**
     * @var ClientKill
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientKill();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT KILL', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments([new \PhpRedis\Parameters\ClientKill(100, 'ID')]);
        self::assertEquals([['ID', '100', 'SKIPME', 'yes']], $this->command->normalizeArguments());
    }
}