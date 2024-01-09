<?php

declare(strict_types=1);

namespace PhpRedis\Traits;

trait AnonymousCommand
{
    private string $command;

    public function getCommand(): string
    {
        return $this->command;
    }

    public function setCommand(string $command): static
    {
        $this->command = $command;

        return $this;
    }
}
