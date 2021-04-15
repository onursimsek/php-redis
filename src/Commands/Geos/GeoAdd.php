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

class GeoAdd implements Command, ArgumentativeCommand, Normalizable
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'GEOADD';
    }

    public function normalizeArguments(): array
    {
        $arguments = [];
        if (!isset($this->arguments[0])) {
            throw new ValidationException('First (key) argument is required');
        }

        $arguments[] = $this->arguments[0];

        if (!isset($this->arguments[1]) || !is_array($this->arguments[1])) {
            throw new ValidationException('Second (members) argument is required');
        }

        foreach ($this->arguments[1] as $member => $coordinates) {
            if (count($coordinates) != 2) {
                throw new ValidationException('Members only have latitude and longitude values');
            }

            $arguments[] = [...$coordinates, $member];
        }

        return Arr::flattenWithKeys($arguments);
    }
}
