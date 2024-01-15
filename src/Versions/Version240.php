<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientKill;
use PhpRedis\Commands\Connections\ClientList;
use PhpRedis\Commands\GenericCommand;

class Version240 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // String commands
            'GETRANGE' => GenericCommand::class,

            // Connection commands
            'CLIENTKILL' => ClientKill::class,
            'CLIENTLIST' => ClientList::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
