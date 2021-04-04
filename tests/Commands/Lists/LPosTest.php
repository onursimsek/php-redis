<?php

namespace PhpRedis\Tests\Commands\Lists;

use PhpRedis\Commands\Lists\LPos;
use PhpRedis\Tests\Commands\BaseCommand;

class LPosTest extends BaseCommand
{
    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('LPOS', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['key', 'element']);
        self::assertEquals(['key', 'element'], $this->command->normalizeArguments());

        $this->command->setArguments(['key', 'element', ['COUNT' => 0, 'RANK' => 1, 'MAXLEN' => 2]]);
        self::assertEquals(
            ['key', 'element', 'COUNT', 0, 'RANK', 1, 'MAXLEN', 2],
            $this->command->normalizeArguments()
        );

        $this->command->setArguments(['key', 'element', ['COUNT' => 0, 'FOO' => 1]]);
        self::assertEquals(['key', 'element', 'COUNT', 0], $this->command->normalizeArguments());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new LPos();
    }
}
