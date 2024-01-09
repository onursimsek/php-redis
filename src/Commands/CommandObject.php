<?php

declare(strict_types=1);

namespace PhpRedis\Commands;

class CommandObject
{
    public function __construct(private readonly string $class, private readonly array $rules = [])
    {
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getRules(): array
    {
        return $this->rules;
    }
}
