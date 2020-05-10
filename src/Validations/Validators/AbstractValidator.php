<?php

declare(strict_types=1);

namespace PhpRedis\Validations\Validators;

class AbstractValidator
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var array|null
     */
    protected $parameters;

    public function __construct(string $key, $value, array $parameters = [])
    {
        $this->key = $key;
        $this->value = $value;
        $this->parameters = $parameters;
    }
}