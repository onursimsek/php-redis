<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientCaching;
use PhpRedis\Commands\Connections\ClientGetRedirecting;

class Version600 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'SET' => $this->commandObject(),
            'STRALGOLCS' => $this->commandObject(),

            // Connection commands
            'CLIENTCACHING' => $this->commandObject(ClientCaching::class),
            'CLIENTGETREDIR' => $this->commandObject(ClientGetRedirecting::class),
            'CLIENTTRACKING' => $this->commandObject(),
            'HELLO' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
