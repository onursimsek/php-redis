<?php

namespace PhpRedis\Tests\Commands\SortedSets;

use PhpRedis\Commands\SortedSets\ZAdd;
use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Tests\Commands\BaseCommand;

class ZAddTest extends BaseCommand
{
    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('ZADD', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['key', ['foo' => 1, 'bar' => 2]]);
        self::assertEquals(['key', 1, 'foo', 2, 'bar'], $this->command->normalizeArguments());

        $this->command->setArguments(['key', ['foo' => 1, 'bar' => 2], ['GT']]);
        self::assertEquals(['key', 'GT', 1, 'foo', 2, 'bar'], $this->command->normalizeArguments());
    }

    public function test_the_command_can_be_convert_to_array()
    {
        $this->command->setArguments(['key', ['foo' => 1, 'bar' => 2]]);
        self::assertEquals(['ZADD' ,'key', 1, 'foo', 2, 'bar'], $this->command->toArray());

        $this->command->setArguments(['key', ['foo' => 1, 'bar' => 2], ['GT']]);
        self::assertEquals(['ZADD', 'key', 'GT', 1, 'foo', 2, 'bar'], $this->command->toArray());
    }

    public function test_the_command_can_not_be_normalize_multi_element_with_increment_option()
    {
        $this->command->setArguments(['key', ['foo' => 1, 'bar' => 2], ['INCR']]);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }

    public function test_the_command_can_not_be_normalize_nx_and_gt_options()
    {
        $this->command->setArguments(['key', ['foo' => 1, 'bar' => 2], ['NX', 'GT']]);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }

    public function test_the_command_can_not_be_normalize_nx_and_lt_options()
    {
        $this->command->setArguments(['key', ['foo' => 1, 'bar' => 2], ['NX', 'LT']]);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ZAdd();
    }
}