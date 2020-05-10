<?php

declare(strict_types=1);

namespace PhpRedis\Validations\Validators;

class StringValidator extends AbstractValidator implements Validator
{
    public function validate(): bool
    {
        return is_string($this->value);
    }

    public function getErrorMessage(): string
    {
        return "The '{$this->key}' key must be string.";
    }
}