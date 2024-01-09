<?php

namespace PhpRedis\Tests\Commands\Lists;

use PhpRedis\Commands\Lists\LPos;
use PhpRedis\Tests\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(LPos::class)]
class LPosTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new LPos();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('LPOS', $this->command->getCommand());
    }

    #[Test]
    public function the_command_can_be_normalize_arguments()
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
}
