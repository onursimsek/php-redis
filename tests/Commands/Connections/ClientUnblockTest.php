<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientUnblock;
use PhpRedis\Tests\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(ClientUnblock::class)]
class ClientUnblockTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientUnblock();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT UNBLOCK', $this->command->getCommand());
    }
}
