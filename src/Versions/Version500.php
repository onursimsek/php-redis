<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\CommandObject;
use PhpRedis\Commands\Connections\ClientId;
use PhpRedis\Commands\Connections\ClientUnblock;

class Version500 implements Version
{
    public function added(): iterable
    {
        return [
            // Connection commands
            'CLIENTID' => new CommandObject( ClientId::class),
            'CLIENTUNBLOCK' => new CommandObject( ClientUnblock::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}