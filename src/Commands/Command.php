<?php

namespace PhpRedis\Commands;

interface Command
{
    public function getCommand();

    public function getArguments(): array;

    public function setArguments(array $arguments);

    public function __toString(): string;
}