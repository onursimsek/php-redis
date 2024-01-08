<?php

declare(strict_types=1);

namespace PhpRedis\Commands;

interface ArgumentativeCommand
{
    /**
     * Get command arguments
     *
     * @return array
     */
    public function getArguments(): array;

    /**
     * Set command arguments
     *
     * @param array $arguments
     */
    public function setArguments(array $arguments);
}
