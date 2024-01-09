<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientId;
use PhpRedis\Tests\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(ClientId::class)]
class ClientIdTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientId();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT ID', $this->command->getCommand());
    }
}
