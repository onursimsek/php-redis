<?php

declare(strict_types=1);

namespace PhpRedis\Validations;

use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Exceptions\PhpRedisException;
use PhpRedis\Exceptions\ValidatorNotFoundException;
use PhpRedis\Validations\Validators\Validator;

class Validation implements ValidationInterface
{
    /**
     * @var array
     */
    private $parameters;

    /**
     * @var array
     */
    private $rules;

    public function __construct(array $parameters = [], array $rules = [])
    {
        $this->parameters = $parameters;
        $this->rules = $rules;

        if (count($this->parameters) != count($this->rules)) {
            throw new PhpRedisException('Parameters and rules count must be equal');
        }
    }

    public function validate(): bool
    {
        foreach ($this->parameters as $key => $value) {
            foreach ((array)$this->rules[$key] as $rule) {
                $validator = $this->createValidatorFromRule($rule, $key, $value);
                if (!$validator->validate()) {
                    throw new ValidationException($validator->getErrorMessage());
                }
            }
        }

        return true;
    }

    private function createValidatorFromRule($rule, $key, $value): Validator
    {
        [$validatorName, $parameters] = explode(':', $rule);
        $validatorName = mb_convert_case($validatorName, MB_CASE_TITLE);

        $validatorClassName = 'PhpRedis\Validations\Validators\\' . $validatorName . 'Validator';
        if (!class_exists($validatorClassName)) {
            throw new ValidatorNotFoundException(sprintf('The %s validator is not found', $validatorName));
        }

        $parameters = $parameters ? explode(',', $parameters) : [];

        return new $validatorClassName($key, $value, $parameters);
    }
}