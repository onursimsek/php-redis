<?php

namespace PhpRedis\Tests\Unit\Commands\Connections;

use PhpRedis\Commands\Connections\ClientKill;
use PhpRedis\Tests\Unit\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\Test;

class ClientKillTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientKill();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT KILL', $this->command->getCommand());
    }

    #[Test]
    public function the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments([new \PhpRedis\Parameters\ClientKill(100, 'ID')]);
        self::assertEquals([['ID', '100', 'SKIPME', 'yes']], $this->command->normalizeArguments());
    }
}
