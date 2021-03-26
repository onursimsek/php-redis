<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Sets;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class SScan implements Command, Normalizable, ArgumentativeCommand
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'SSCAN';
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
