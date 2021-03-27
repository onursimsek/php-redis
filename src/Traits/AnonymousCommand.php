<?php

declare(strict_types=1);

namespace PhpRedis\Traits;

trait AnonymousCommand
{
    private string $command;

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @param string $command
     * @return self
     */
    public function setCommand(string $command): self
    {
        $this->command = $command;
        return $this;
    }
}
