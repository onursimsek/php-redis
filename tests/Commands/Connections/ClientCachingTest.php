<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientCaching;
use PhpRedis\Tests\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(ClientCaching::class)]
class ClientCachingTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientCaching();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT CACHING', $this->command->getCommand());
    }

    #[Test]
    public function the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments([true]);
        self::assertEquals(['yes'], $this->command->normalizeArguments());

        $this->command->setArguments([false]);
        self::assertEquals(['no'], $this->command->normalizeArguments());
    }
}
