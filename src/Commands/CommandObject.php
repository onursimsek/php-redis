<?php

declare(strict_types=1);

namespace PhpRedis\Commands;

class CommandObject
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var array
     */
    private $rules = [];

    public function __construct(string $class, array $rules = [])
    {
        $this->class = $class;
        $this->rules = $rules;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}