<?php

namespace PhpRedis\Tests\Validations\Validators;

use PhpRedis\Validations\Validators\RequiredValidator;
use PHPUnit\Framework\TestCase;

class RequiredValidatorTest extends TestCase implements Validator
{
    public function test_validation_can_be_passed_with_correct_parameters()
    {
        $validator = new RequiredValidator('foo', 'bar');
        self::assertTrue($validator->validate());
    }

    public function test_validation_should_not_be_passed_with_wrong_parameters()
    {
        $validator = new RequiredValidator('foo');
        self::assertFalse($validator->validate());
    }

    public function test_error_message_should_be_string()
    {
        $validator = new RequiredValidator('foo');
        self::assertIsString($validator->getErrorMessage());
    }
}