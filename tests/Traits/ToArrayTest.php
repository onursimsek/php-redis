<?php

namespace PhpRedis\Tests\Traits;

use PhpRedis\Commands\Connections\Auth;
use PhpRedis\Commands\GenericCommand;
use PHPUnit\Framework\TestCase;

class ToArrayTest extends TestCase
{
    public function test_the_trait_can_be_convert_to_array_a_argumentative_command()
    {
        $command = new GenericCommand();
        $command->setCommand('SET')
            ->setArguments(['key', 'value']);

        self::assertEquals(['SET', 'key', 'value'], $command->toArray());
    }

    public function test_the_trait_can_be_convert_to_array_a_normalize_command()
    {
        $command = new Auth();
        $command->setArguments(['password', 'username']);

        self::assertEquals(['AUTH', 'username', 'password'], $command->toArray());
    }
}