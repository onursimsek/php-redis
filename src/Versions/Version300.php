<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;

class Version300 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // Key commands
            'WAIT' => GenericCommand::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
