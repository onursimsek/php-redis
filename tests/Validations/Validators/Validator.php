<?php

declare(strict_types=1);

namespace PhpRedis\Tests\Validations\Validators;

interface Validator
{
    public function test_validation_can_be_passed_with_correct_parameters();

    public function test_validation_should_not_be_passed_with_wrong_parameters();

    public function test_error_message_should_be_string();
}