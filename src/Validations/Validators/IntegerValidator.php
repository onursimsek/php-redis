<?php

declare(strict_types=1);

namespace PhpRedis\Validations\Validators;

class IntegerValidator extends AbstractValidator implements Validator
{
    public function validate(): bool
    {
        return is_int($this->value);
    }

    public function getErrorMessage(): string
    {
        return sprintf('The \'%s\' key must be integer.', $this->key);
    }
}