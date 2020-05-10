<?php

namespace PhpRedis\Tests\Validations;

use PhpRedis\Exceptions\PhpRedisException;
use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Exceptions\ValidatorNotFoundException;
use PhpRedis\Validations\Validation;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    public function test_validation_can_be_passed_with_correct_parameters_and_rules()
    {
        $parameters = ['key' => 'foo', 'value' => 'bar'];
        $rules = ['key' => ['required', 'string'], 'value' => ['required', 'string']];

        $validation = new Validation($parameters, $rules);
        self::assertTrue($validation->validate());
    }

    public function test_throw_exception_on_validation_fail()
    {
        $parameters = ['key' => 'foo', 'value' => null];
        $rules = ['key' => ['required', 'string'], 'value' => ['required']];

        $validation = new Validation($parameters, $rules);
        self::expectException(ValidationException::class);
        $validation->validate();
    }

    public function test_parameters_and_rules_count_should_be_equal()
    {
        $parameters = ['key' => 'foo', 'value' => 'bar'];
        $rules = ['key' => ['required', 'string']];

        self::expectException(PhpRedisException::class);
        self::expectExceptionMessage('Parameters and rules count must be equal');

        new Validation($parameters, $rules);
    }

    public function test_throw_exception_on_wrong_rule()
    {
        $parameters = ['key' => 'foo'];
        $rules = ['key' => ['foo']];

        $validation = new Validation($parameters, $rules);

        self::expectException(ValidatorNotFoundException::class);
        $validation->validate();
    }
}