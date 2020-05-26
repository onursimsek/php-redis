<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientCaching;
use PHPUnit\Framework\TestCase;

class ClientCachingTest extends TestCase
{
    /**
     * @var ClientCaching
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientCaching();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT CACHING', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments([true]);
        self::assertEquals(['yes'], $this->command->normalizeArguments());

        $this->command->setArguments([false]);
        self::assertEquals(['no'], $this->command->normalizeArguments());
    }
}