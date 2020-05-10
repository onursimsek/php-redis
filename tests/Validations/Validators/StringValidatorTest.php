<?php

namespace PhpRedis\Tests\Validations\Validators;

use PhpRedis\Validations\Validators\StringValidator;
use PHPUnit\Framework\TestCase;

class StringValidatorTest extends TestCase implements Validator
{
    public function test_validation_can_be_passed_with_correct_parameters()
    {
        $validator = new StringValidator('foo', 'bar');
        self::assertTrue($validator->validate());
    }

    public function test_validation_should_not_be_passed_with_wrong_parameters()
    {
        $validator = new StringValidator('foo', 1);
        self::assertFalse($validator->validate());
    }

    public function test_error_message_should_be_string()
    {
        $validator = new StringValidator('foo', 'bar');
        self::assertIsString($validator->getErrorMessage());
    }
}