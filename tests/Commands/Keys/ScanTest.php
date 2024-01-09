<?php

namespace PhpRedis\Tests\Commands\Keys;

use PhpRedis\Commands\Keys\Scan;
use PhpRedis\Tests\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(Scan::class)]
class ScanTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new Scan();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('SCAN', $this->command->getCommand());
    }

    #[Test]
    public function the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['cursor']);
        self::assertEquals(['cursor'], $this->command->normalizeArguments());

        $this->command->setArguments(['cursor', '*']);
        self::assertEquals(['cursor', 'MATCH', '*'], $this->command->normalizeArguments());

        $this->command->setArguments(['cursor', '*', 10]);
        self::assertEquals(['cursor', 'MATCH', '*', 'COUNT', 10], $this->command->normalizeArguments());

        $this->command->setArguments(['cursor', null, 10]);
        self::assertEquals(['cursor', 'COUNT', 10], $this->command->normalizeArguments());

        $this->command->setArguments(['cursor', null, null, 'zset']);
        self::assertEquals(['cursor', 'TYPE', 'zset'], $this->command->normalizeArguments());
    }
}
