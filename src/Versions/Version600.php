<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientCaching;
use PhpRedis\Commands\Connections\ClientGetRedirecting;
use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\Lists\LPos;

class Version600 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // String commands
            'SET' => GenericCommand::class,
            'STRALGOLCS' => GenericCommand::class,

            // Connection commands
            'CLIENTCACHING' => ClientCaching::class,
            'CLIENTGETREDIR' => ClientGetRedirecting::class,
            'CLIENTTRACKING' => GenericCommand::class,
            'HELLO' => GenericCommand::class,

            // List commands
            'LPOS' => LPos::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
