<?php

namespace PhpRedis\Tests\Unit\Commands\SortedSets;

use PhpRedis\Commands\SortedSets\ZScan;
use PhpRedis\Tests\Unit\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\Test;

class ZScanTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ZScan();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('ZSCAN', $this->command->getCommand());
    }

    #[Test]
    public function the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['key', 'cursor']);
        self::assertEquals(['key', 'cursor'], $this->command->normalizeArguments());

        $this->command->setArguments(['key', 'cursor', '*']);
        self::assertEquals(['key', 'cursor', 'MATCH', '*'], $this->command->normalizeArguments());

        $this->command->setArguments(['key', 'cursor', '*', 10]);
        self::assertEquals(['key', 'cursor', 'MATCH', '*', 'COUNT', 10], $this->command->normalizeArguments());

        $this->command->setArguments(['key', 'cursor', null, 10]);
        self::assertEquals(['key', 'cursor', 'COUNT', 10], $this->command->normalizeArguments());
    }
}
