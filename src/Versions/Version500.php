<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientId;
use PhpRedis\Commands\Connections\ClientUnblock;

class Version500 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // Connection commands
            'CLIENTID' => $this->commandObject(ClientId::class),
            'CLIENTUNBLOCK' => $this->commandObject(ClientUnblock::class),

            // Sorted set commands
            'BZPOPMAX' => $this->commandObject(),
            'BZPOPMIN' => $this->commandObject(),
            'ZPOPMAX' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
