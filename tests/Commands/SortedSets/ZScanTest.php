<?php

namespace PhpRedis\Tests\Commands\SortedSets;

use PhpRedis\Commands\SortedSets\ZScan;
use PhpRedis\Tests\Commands\BaseCommand;

class ZScanTest extends BaseCommand
{

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('ZSCAN', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
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

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ZScan();
    }
}