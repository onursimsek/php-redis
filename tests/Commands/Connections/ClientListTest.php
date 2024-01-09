<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\ClientList;
use PhpRedis\Tests\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(ClientList::class)]
class ClientListTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ClientList();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('CLIENT LIST', $this->command->getCommand());
    }

    #[Test]
    public function the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['normal']);
        self::assertEquals(['TYPE', 'normal'], $this->command->normalizeArguments());
    }
}
