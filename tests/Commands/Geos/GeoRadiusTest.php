<?php

namespace PhpRedis\Tests\Commands\Geos;

use PhpRedis\Commands\Geos\GeoRadius;
use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Tests\Commands\BaseCommand;

class GeoRadiusTest extends BaseCommand
{

    public function test_the_command_should_have_a_name()
    {
        self::assertEquals('GEORADIUS', $this->command->getCommand());
    }

    public function test_the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['Turkey', 15, 50, 500, 'km']);
        self::assertEquals(['Turkey', 15, 50, 500, 'km'], $this->command->normalizeArguments());

        $this->command->setArguments(
            [
                'Turkey',
                15,
                50,
                500,
                'km',
                [GeoRadius::WITHCOORD, GeoRadius::WITHDIST, GeoRadius::WITHHASH, GeoRadius::COUNT => 5, GeoRadius::ASC]
            ]
        );
        self::assertEquals(
            [
                'Turkey',
                15,
                50,
                500,
                'km',
                GeoRadius::WITHCOORD,
                GeoRadius::WITHDIST,
                GeoRadius::WITHHASH,
                GeoRadius::COUNT,
                5,
                GeoRadius::ASC
            ],
            $this->command->normalizeArguments()
        );

        $this->command->setArguments(
            ['Turkey', 15, 50, 500, 'km', [GeoRadius::STORE => 'Turkey-out', GeoRadius::STOREDIST => 'Turkey-dist-out']]
        );
        self::assertEquals(
            ['Turkey', 15, 50, 500, 'km', GeoRadius::STORE, 'Turkey-out', GeoRadius::STOREDIST, 'Turkey-dist-out'],
            $this->command->normalizeArguments()
        );
    }

    public function test_the_command_can_not_be_normalize_invalid_unit()
    {
        $this->command->setArguments(['Turkey', 15, 50, 500, 'mm']);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new GeoRadius();
    }
}
