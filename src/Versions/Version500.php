<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientId;
use PhpRedis\Commands\Connections\ClientUnblock;
use PhpRedis\Commands\GenericCommand;

class Version500 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // Connection commands
            'CLIENTID' => ClientId::class,
            'CLIENTUNBLOCK' => ClientUnblock::class,

            // Sorted set commands
            'BZPOPMAX' => GenericCommand::class,
            'BZPOPMIN' => GenericCommand::class,
            'ZPOPMAX' => GenericCommand::class,
            'ZPOPMIN' => GenericCommand::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
