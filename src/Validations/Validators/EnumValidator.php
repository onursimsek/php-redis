<?php

declare(strict_types=1);

namespace PhpRedis\Validations\Validators;

class EnumValidator extends AbstractValidator implements Validator
{
    public function validate(): bool
    {
        return in_array($this->value, $this->parameters);
    }

    public function getErrorMessage(): string
    {
        return sprintf(
            'The %s is invalid. Acceptable values: %s. Your value: %s',
            $this->key,
            implode(', ', $this->parameters),
            $this->value
        );
    }
}