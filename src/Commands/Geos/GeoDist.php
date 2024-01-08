<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Geos;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class GeoDist implements Command, ArgumentativeCommand, Normalizable
{
    use Stringify;
    use ToArray;
    use HasArguments;

    public const UNIT_METERS = 'm';
    public const UNIT_KILOMETERS = 'km';
    public const UNIT_FEET = 'ft';
    public const UNIT_MILES = 'mi';
    private const UNITS = [
        self::UNIT_METERS,
        self::UNIT_KILOMETERS,
        self::UNIT_FEET,
        self::UNIT_MILES,
    ];

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'GEODIST';
    }

    public function normalizeArguments(): array
    {
        if (! isset($this->arguments[3])) {
            $this->arguments[3] = self::UNIT_METERS;
        }

        if (! in_array($this->arguments[3], self::UNITS)) {
            throw new ValidationException(
                sprintf('The unit argument does not exist in %s', implode(', ', self::UNITS))
            );
        }

        return $this->arguments;
    }
}
