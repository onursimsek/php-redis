<?php

declare(strict_types=1);

namespace PhpRedis\Commands\SortedSets;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Helpers\Arr;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class ZRevRangeByLex implements Command, ArgumentativeCommand, Normalizable
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'ZREVRANGEBYLEX';
    }

    public function normalizeArguments(): array
    {
        $arguments = array_slice($this->arguments, 0, 3);
        if (isset($this->arguments[3]) && is_array($this->arguments[3])) {
            $arguments[] = ['LIMIT' => $this->arguments[3]];
        }

        return Arr::flattenWithKeys($arguments);
    }
}
