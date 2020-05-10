<?php

declare(strict_types=1);

namespace PhpRedis\Validations\Validators;

class RequiredValidator implements Validator
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var null|mixed
     */
    private $value;

    public function __construct(string $key, $value = null)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function validate(): bool
    {
        return !is_null($this->value);
    }

    public function getErrorMessage(): string
    {
        return sprintf('%s is required', $this->key);
    }
}