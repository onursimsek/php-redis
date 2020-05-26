<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientList;
use PHPUnit\Framework\TestCase;

class ClientListTest extends TestCase
{
    /**
     * @var ClientList
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientList();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT LIST', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['normal']);
        self::assertEquals(['TYPE', 'normal'], $this->command->normalizeArguments());
    }
}