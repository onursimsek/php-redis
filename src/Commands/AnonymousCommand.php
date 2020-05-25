<?php

declare(strict_types=1);

namespace PhpRedis\Commands;

interface AnonymousCommand
{
    public function setCommand(string $command);
}