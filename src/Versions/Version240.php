<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientKill;
use PhpRedis\Commands\Connections\ClientList;

class Version240 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'GETRANGE' => $this->commandObject(),

            // Connection commands
            'CLIENTKILL' => $this->commandObject(ClientKill::class),
            'CLIENTLIST' => $this->commandObject(ClientList::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
