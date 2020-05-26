<?php

namespace PhpRedis\Tests\Commands\Connections;

use PhpRedis\Commands\Connections\Auth;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    /**
     * @var Auth
     */
    protected $command;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->command = new Auth();
    }

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('AUTH', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['password']);
        self::assertEquals(['password'], $this->command->normalizeArguments());

        $this->command->setArguments(['password', 'username']);
        self::assertEquals(['username', 'password'], $this->command->normalizeArguments());
    }

    public function test_the_command_can_be_convert_to_array()
    {
        $this->command->setArguments(['password']);
        self::assertEquals(['AUTH', 'password'], $this->command->toArray());

        $this->command->setArguments(['password', 'username']);
        self::assertEquals(['AUTH', 'username', 'password'], $this->command->toArray());
    }
}