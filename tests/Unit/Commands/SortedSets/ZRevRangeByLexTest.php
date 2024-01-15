<?php

namespace PhpRedis\Tests\Unit\Commands\SortedSets;

use PhpRedis\Commands\SortedSets\ZRevRangeByLex;
use PhpRedis\Tests\Unit\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\Test;

class ZRevRangeByLexTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ZRevRangeByLex();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('ZREVRANGEBYLEX', $this->command->getCommand());
    }

    #[Test]
    public function the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['key', '+', '-']);
        self::assertEquals(['key', '+', '-'], $this->command->normalizeArguments());

        $this->command->setArguments(['key', '+', '-', [0, 2]]);
        self::assertEquals(['key', '+', '-', 'LIMIT', 0, 2], $this->command->normalizeArguments());
    }
}
