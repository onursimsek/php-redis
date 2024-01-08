<?php

declare(strict_types=1);

namespace PhpRedis\Commands;

interface Normalizable
{
    /**
     * Normalize arguments before serialization
     *
     * @return array
     */
    public function normalizeArguments(): array;
}
