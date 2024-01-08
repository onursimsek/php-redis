<?php

namespace PhpRedis\Commands;

interface Command
{
    /**
     * Redis command name
     *
     * @return string
     */
    public function getCommand(): string;

    /**
     * Convert command to array for serialization
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Serialize according to RESP
     *
     * @return string
     */
    public function __toString(): string;
}
