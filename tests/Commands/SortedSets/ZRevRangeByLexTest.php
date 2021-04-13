<?php

namespace PhpRedis\Tests\Commands\SortedSets;

use PhpRedis\Commands\SortedSets\ZRevRangeByLex;
use PhpRedis\Tests\Commands\BaseCommand;

class ZRevRangeByLexTest extends BaseCommand
{

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('ZREVRANGEBYLEX', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['key', '+', '-']);
        self::assertEquals(['key', '+', '-'], $this->command->normalizeArguments());

        $this->command->setArguments(['key', '+', '-', [0, 2]]);
        self::assertEquals(['key', '+', '-', 'LIMIT', 0, 2], $this->command->normalizeArguments());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ZRevRangeByLex();
    }
}
