<?php

namespace PhpRedis\Tests\Unit\Commands\Connections;

use PhpRedis\Commands\Connections\ClientPause;
use PhpRedis\Tests\Unit\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\Test;

class ClientPauseTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientPause();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT PAUSE', $this->command->getCommand());
    }
}
