<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Keys;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class Scan implements Command, Normalizable, ArgumentativeCommand
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'SCAN';
    }

    public function normalizeArguments(): array
    {
        [$cursor, $match, $count, $type] = array_pad($this->arguments, 4, null);
        $arguments = [$cursor];

        if ($match) {
            $arguments = array_merge($arguments, ['MATCH', $match]);
        }

        if ($count) {
            $arguments = array_merge($arguments, ['COUNT', $count]);
        }

        if ($type) {
            $arguments = array_merge($arguments, ['TYPE', $type]);
        }

        return $arguments;
    }
}
