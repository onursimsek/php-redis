<?php

namespace PhpRedis\Tests\Commands;

use PHPUnit\Framework\TestCase;

abstract class BaseCommand extends TestCase
{
    protected $command;

    abstract public function test_the_command_should_have_a_name();

    abstract public function test_the_command_can_be_normalize_arguments();

    abstract public function test_the_command_can_be_convert_to_array();
}
