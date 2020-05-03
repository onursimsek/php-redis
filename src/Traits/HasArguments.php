<?php

namespace PhpRedis\Traits;

trait HasArguments
{
    /**
     * @var array
     */
    private $arguments = [];

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     * @return $this
     */
    public function setArguments(array $arguments): self
    {
        $this->arguments = $arguments;
        return $this;
    }
}