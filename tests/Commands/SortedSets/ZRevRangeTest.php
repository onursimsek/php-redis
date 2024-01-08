<?php

namespace PhpRedis\Tests\Commands\SortedSets;

use PhpRedis\Commands\SortedSets\ZRevRange;
use PhpRedis\Tests\Commands\BaseCommand;

class ZRevRangeTest extends BaseCommand
{
    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('ZREVRANGE', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['key', 0, -1]);
        self::assertEquals(['key', 0, -1], $this->command->normalizeArguments());

        $this->command->setArguments(['key', 0, -1, false]);
        self::assertEquals(['key', 0, -1], $this->command->normalizeArguments());

        $this->command->setArguments(['key', 0, -1, true]);
        self::assertEquals(['key', 0, -1, 'WITHSCORES'], $this->command->normalizeArguments());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ZRevRange();
    }
}
