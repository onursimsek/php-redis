<?php

namespace PhpRedis\Tests\Commands;

use PhpRedis\Commands\Command;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

abstract class BaseCommand extends TestCase
{
    protected Command $command;

    #[Test]
    abstract public function the_command_should_have_a_name();
}
