<?php

declare(strict_types=1);

namespace PhpRedis\Validations\Validators;

class FloatValidator extends AbstractValidator implements Validator
{
    public function validate(): bool
    {
        return is_float($this->value);
    }

    public function getErrorMessage(): string
    {
        return "The '{$this->key}' key must be float.";
    }
}