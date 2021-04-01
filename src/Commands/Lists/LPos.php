<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Lists;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Helpers\Arr;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class LPos implements Command, ArgumentativeCommand, Normalizable
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'LPOS';
    }

    public function normalizeArguments(): array
    {
        $arguments = array_slice($this->arguments, 0, 2);

        $options = Arr::only(
            array_change_key_case($this->arguments[2] ?? [], CASE_UPPER),
            ['COUNT', 'RANK', 'MAXLEN']
        );

        return array_merge($arguments, Arr::flattenWithKeys($options));
    }
}
