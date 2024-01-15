<?php

namespace PhpRedis\Versions;

interface Version
{
    public function __construct(?Version $version);

    /**
     * @return class-string[]
     */
    public function toArray(): array;
}
