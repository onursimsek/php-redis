<?php

namespace PhpRedis\Tests\Commands\SortedSets;

use PhpRedis\Commands\SortedSets\ZInterStore;
use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Tests\Commands\BaseCommand;

class ZInterStoreTest extends BaseCommand
{

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('ZINTERSTORE', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['out', 'key']);
        self::assertEquals(['out', 1, 'key'], $this->command->normalizeArguments());

        $this->command->setArguments(['out', ['key01', 'key02']]);
        self::assertEquals(['out', 2, 'key01', 'key02'], $this->command->normalizeArguments());

        $this->command->setArguments(['out', ['key01', 'key02'], ['weights' => [1, 1]]]);
        self::assertEquals(['out', 2, 'key01', 'key02', 'WEIGHTS', 1, 1], $this->command->normalizeArguments());

        $this->command->setArguments(['out', ['key01', 'key02'], ['weights' => [1, 1], 'aggregate' => 'sum']]);
        self::assertEquals(['out', 2, 'key01', 'key02', 'WEIGHTS', 1, 1, 'AGGREGATE', 'sum'], $this->command->normalizeArguments());
    }

    public function test_the_command_can_not_be_normalize_with_different_key_and_weight_counts()
    {
        $this->command->setArguments(['out', ['key01', 'key02'], ['weights' => [1]]]);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }

    public function test_the_command_can_not_be_normalize_with_not_permitted_aggregate_values()
    {
        $this->command->setArguments(['out', ['key01', 'key02'], ['aggregate' => 'avg']]);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new ZInterStore();
    }
}
