<?php

declare(strict_types=1);

namespace PhpRedis\Commands\SortedSets;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class ZRevRange implements Command, ArgumentativeCommand, Normalizable
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'ZREVRANGE';
    }

    public function normalizeArguments(): array
    {
        $arguments = array_slice($this->arguments, 0, 3);
        if (isset($this->arguments[3]) && $this->arguments[3] === true) {
            $arguments[] = 'WITHSCORES';
        }

        return $arguments;
    }
}
