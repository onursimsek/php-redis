<?php

declare(strict_types=1);

namespace PhpRedis\Traits;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Normalizable;

trait ToArray
{
    public function toArray(): array
    {
        if ($this instanceof ArgumentativeCommand) {
            $arguments = $this->getArguments();
        }

        if ($this instanceof Normalizable) {
            $arguments = $this->normalizeArguments();
        }

        return array_merge(explode(' ', $this->getCommand()), $arguments ?? []);
    }
}
