<?php

namespace PhpRedis\Tests\Commands\Geos;

use PhpRedis\Commands\Geos\GeoAdd;
use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Tests\Commands\BaseCommand;

class GeoAddTest extends BaseCommand
{

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('GEOADD', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $actual = ['Turkey', ['Istanbul' => [41.0054958, 28.8721002], 'Tokat' => [40.3134602, 36.4964214]]];
        $expected = ['Turkey', 41.0054958, 28.8721002, 'Istanbul', 40.3134602, 36.4964214, 'Tokat'];
        $this->command->setArguments($actual);
        self::assertEquals($expected, $this->command->normalizeArguments());
    }

    public function test_the_command_can_not_be_normalize_without_first_argument()
    {
        $this->command->setArguments([]);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }

    public function test_the_command_can_not_be_normalize_without_second_argument()
    {
        $this->command->setArguments(['Turkey']);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }

    public function test_the_command_can_not_be_normalize_with_one_coordinate()
    {
        $this->command->setArguments(['Turkey', ['Istanbul' => [41.0054958]]]);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }

    public function test_the_command_can_not_be_normalize_with_more_than_two_coordinate()
    {
        $this->command->setArguments(['Turkey', ['Istanbul' => [41.0054958, 28.8721002, 25.8721]]]);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new GeoAdd();
    }
}
