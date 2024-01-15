<?php

namespace PhpRedis\Tests\Unit\Commands\Connections;

use PhpRedis\Commands\Connections\ClientGetRedirecting;
use PhpRedis\Tests\Unit\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\Test;

class ClientGetRedirectingTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientGetRedirecting();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT GETREDIR', $this->command->getCommand());
    }
}
