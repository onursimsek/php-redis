<?php

declare(strict_types=1);

namespace PhpRedis\Commands\SortedSets;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class ZAdd implements Command, Normalizable, ArgumentativeCommand
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'ZADD';
    }

    public function normalizeArguments(): array
    {
        [$key, $elementsAndScores, $options] = array_pad($this->arguments, 3, []);

        if ((in_array('GT', $options) || in_array('LT', $options)) && in_array('NX', $options)) {
            throw new ValidationException('The GT, LT and NX options are mutually exclusive.');
        }

        if (in_array('INCR', $options) && count($elementsAndScores) > 1) {
            throw new ValidationException('INCR option supports a single increment-element pair');
        }

        $arguments = [$key, ...$options];

        foreach ($elementsAndScores as $element => $score) {
            $arguments = array_merge($arguments, [$score, $element]);
        }

        return $arguments;
    }
}
