<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Geos;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Helpers\Arr;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class GeoRadiusByMember implements Command, ArgumentativeCommand, Normalizable
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

    public const WITHCOORD = 'WITHCOORD';
    public const WITHDIST = 'WITHDIST';
    public const WITHHASH = 'WITHHASH';
    public const COUNT = 'COUNT';
    public const STORE = 'STORE';
    public const STOREDIST = 'STOREDIST';
    public const ASC = 'ASC';
    public const DESC = 'DESC';

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'GEORADIUSBYMEMBER';
    }

    public function normalizeArguments(): array
    {
        [$key, $member, $radius, $unit] = array_slice($this->arguments, 0, 4);
        if (! in_array($unit, self::UNITS)) {
            throw new ValidationException(
                sprintf('The unit argument does not exist in %s', implode(', ', self::UNITS))
            );
        }

        if (! isset($this->arguments[4])) {
            return $this->arguments;
        }

        return [$key, $member, $radius, $unit, ...Arr::flattenWithKeys($this->arguments[4])];
    }
}
