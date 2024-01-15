<?php

namespace PhpRedis\Tests\Commands\Geos;

use PhpRedis\Commands\Geos\GeoDist;
use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Tests\Commands\BaseCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(GeoDist::class)]
class GeoDistTest extends BaseCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new GeoDist();
    }

    #[Test]
    public function the_command_should_have_a_name()
    {
        self::assertEquals('GEODIST', $this->command->getCommand());
    }

    #[Test]
    public function the_command_can_be_normalize_arguments()
    {
        $this->command->setArguments(['Turkey', 'Istanbul', 'Tokat']);
        self::assertEquals(['Turkey', 'Istanbul', 'Tokat', GeoDist::UNIT_METERS], $this->command->normalizeArguments());

        $this->command->setArguments(['Turkey', 'Istanbul', 'Tokat', 'km']);
        self::assertEquals(
            ['Turkey', 'Istanbul', 'Tokat', GeoDist::UNIT_KILOMETERS],
            $this->command->normalizeArguments()
        );
    }

    #[Test]
    public function the_command_can_not_be_normalize_invalid_unit()
    {
        $this->command->setArguments(['Turkey', 'Istanbul', 'Tokat', 'mm']);
        self::expectException(ValidationException::class);
        $this->command->normalizeArguments();
    }
}
