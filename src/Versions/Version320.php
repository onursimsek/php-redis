<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientPause;
use PhpRedis\Commands\Connections\ClientReply;
use PhpRedis\Commands\Geos\GeoAdd;

class Version320 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'BITFIELD' => $this->commandObject(),

            // Connection commands
            'CLIENTPAUSE' => $this->commandObject(ClientPause::class),
            'CLIENTREPLY' => $this->commandObject(ClientReply::class),

            // Key commands
            'TOUCH' => $this->commandObject(),

            // Hash commands
            'HSTRLEN' => $this->commandObject(),

            // Geo commands
            'GEOADD' => $this->commandObject(GeoAdd::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
