<?php

namespace PhpRedis\Tests\Commands\Keys;

use PhpRedis\Commands\Keys\Scan;
use PhpRedis\Tests\Commands\BaseCommand;

class ScanTest extends BaseCommand
{
    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('SCAN', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
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

    public function test_the_command_can_be_convert_to_array()
    {
        $this->command->setArguments(['cursor']);
        self::assertEquals(['SCAN', 'cursor'], $this->command->toArray());

        $this->command->setArguments(['cursor', '*']);
        self::assertEquals(['SCAN', 'cursor', 'MATCH', '*'], $this->command->toArray());

        $this->command->setArguments(['cursor', '*', 10]);
        self::assertEquals(['SCAN', 'cursor', 'MATCH', '*', 'COUNT', 10], $this->command->toArray());

        $this->command->setArguments(['cursor', null, 10]);
        self::assertEquals(['SCAN', 'cursor', 'COUNT', 10], $this->command->toArray());

        $this->command->setArguments(['cursor', null, null, 'zset']);
        self::assertEquals(['SCAN', 'cursor', 'TYPE', 'zset'], $this->command->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new Scan();
    }
}
