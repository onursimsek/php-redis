<?php

namespace PhpRedis\Tests\Unit\Commands\Keys;

use PhpRedis\Commands\Keys\Sort;
use PhpRedis\Tests\Unit\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\Test;

class SortTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new Sort();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('SORT', $this->command->getCommand());
    }

    #[Test]
    public function the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['key']);
        self::assertEquals(['key'], $this->command->normalizeArguments());

        $this->command->setArguments(
            [
                'key',
                [
                    Sort::OPTION_DIRECTION => Sort::DESC,
                    Sort::OPTION_SORT => Sort::SORT_ALPHA,
                    Sort::OPTION_STORE => 'other_key',
                ],
            ]
        );
        self::assertEquals(['key', Sort::DESC, Sort::SORT_ALPHA, 'other_key'], $this->command->normalizeArguments());

        $this->command->setArguments(
            [
                'key',
                [
                    Sort::OPTION_BY => 'by*',
                    Sort::OPTION_GET => 'get*',
                    Sort::OPTION_LIMIT => '0 10',
                ],
            ]
        );
        self::assertEquals(
            ['key', Sort::OPTION_BY, 'by*', Sort::OPTION_GET, 'get*', Sort::OPTION_LIMIT, '0 10'],
            $this->command->normalizeArguments()
        );
    }
}
