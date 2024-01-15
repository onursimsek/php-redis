<?php

namespace PhpRedis\Tests\Unit\Traits;

use PhpRedis\Commands\Connections\Auth;
use PhpRedis\Commands\GenericCommand;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ToArrayTest extends TestCase
{
    #[Test]
    public function the_trait_can_be_convert_to_array_a_argumentative_command()
    {
        $command = new GenericCommand();
        $command->setCommand('SET')
            ->setArguments(['key', 'value']);

        self::assertEquals(['SET', 'key', 'value'], $command->toArray());
    }

    #[Test]
    public function the_trait_can_be_convert_to_array_a_normalize_command()
    {
        $command = new Auth();
        $command->setArguments(['password', 'username']);

        self::assertEquals(['AUTH', 'username', 'password'], $command->toArray());
    }
}
