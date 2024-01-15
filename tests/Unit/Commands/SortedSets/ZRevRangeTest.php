<?php

namespace PhpRedis\Tests\Unit\Commands\SortedSets;

use PhpRedis\Commands\SortedSets\ZRevRange;
use PhpRedis\Tests\Unit\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\Test;

class ZRevRangeTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ZRevRange();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('ZREVRANGE', $this->command->getCommand());
    }

    #[Test]
    public function the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['key', 0, -1]);
        self::assertEquals(['key', 0, -1], $this->command->normalizeArguments());

        $this->command->setArguments(['key', 0, -1, false]);
        self::assertEquals(['key', 0, -1], $this->command->normalizeArguments());

        $this->command->setArguments(['key', 0, -1, true]);
        self::assertEquals(['key', 0, -1, 'WITHSCORES'], $this->command->normalizeArguments());
    }
}
