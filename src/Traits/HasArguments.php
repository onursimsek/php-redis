<?php

namespace PhpRedis\Traits;

trait HasArguments
{
    private array $arguments = [];

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function setArguments(array $arguments): static
    {
        $this->arguments = $arguments;

        return $this;
    }
}
