<?php

declare(strict_types=1);

namespace PhpRedis\Validations;

interface ValidationInterface
{
    public function __construct(array $parameters = [], array $rules = []);

    public function validate(): bool;
}