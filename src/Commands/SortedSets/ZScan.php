<?php

declare(strict_types=1);

namespace PhpRedis\Commands\SortedSets;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class ZScan implements Command, Normalizable, ArgumentativeCommand
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'ZSCAN';
    }

    public function normalizeArguments(): array
    {
        [$key, $cursor, $match, $count] = array_pad($this->arguments, 4, null);
        $arguments = [$key, $cursor];

        if ($match) {
            $arguments = array_merge($arguments, ['MATCH', $match]);
        }

        if ($count) {
            $arguments = array_merge($arguments, ['COUNT', $count]);
        }

        return $arguments;
    }
}
