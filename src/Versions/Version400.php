<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;

class Version400 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            'UNLINK' => GenericCommand::class,
        ];
    }

    protected function pull(): array
    {
        return [
            // Hash commands
            'HMSET',
        ];
    }
}
