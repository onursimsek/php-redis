<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientId;
use PhpRedis\Commands\Connections\ClientUnblock;

class Version500 implements Version
{
    public function addedCommands(): array
    {
        return [
            // Connection commands
            'CLIENTID' => [
                'class' => ClientId::class,
                'rules' => [],
            ],
            'CLIENTUNBLOCK' => [
                'class' => ClientUnblock::class,
                'rules' => [],
            ],
        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}