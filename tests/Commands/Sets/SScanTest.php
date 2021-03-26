<?php

namespace PhpRedis\Tests\Commands\Sets;

use PhpRedis\Commands\Sets\SScan;
use PHPUnit\Framework\TestCase;

class SScanTest extends TestCase
{
    /**
     * @var SScan
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new SScan();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('SSCAN', $this->command->getCommand());
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

    public function test_the_command_can_be_convert_to_array()
    {
        $this->command->setArguments(['key', 'cursor']);
        self::assertEquals(['SSCAN', 'key', 'cursor'], $this->command->toArray());

        $this->command->setArguments(['key', 'cursor', '*']);
        self::assertEquals(['SSCAN', 'key', 'cursor', 'MATCH', '*'], $this->command->toArray());

        $this->command->setArguments(['key', 'cursor', '*', 10]);
        self::assertEquals(['SSCAN', 'key', 'cursor', 'MATCH', '*', 'COUNT', 10], $this->command->toArray());

        $this->command->setArguments(['key', 'cursor', null, 10]);
        self::assertEquals(['SSCAN', 'key', 'cursor', 'COUNT', 10], $this->command->toArray());
    }
}
