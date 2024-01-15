<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientPause;
use PhpRedis\Commands\Connections\ClientReply;
use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\Geos\GeoAdd;
use PhpRedis\Commands\Geos\GeoDist;
use PhpRedis\Commands\Geos\GeoRadius;

class Version320 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // String commands
            'BITFIELD' => GenericCommand::class,

            // Connection commands
            'CLIENTPAUSE' => ClientPause::class,
            'CLIENTREPLY' => ClientReply::class,

            // Key commands
            'TOUCH' => GenericCommand::class,

            // Hash commands
            'HSTRLEN' => GenericCommand::class,

            // Geo commands
            'GEOADD' => GeoAdd::class,
            'GEODIST' => GeoDist::class,
            'GEOHASH' => GenericCommand::class,
            'GEOPOS' => GenericCommand::class,
            'GEORADIUS' => GeoRadius::class,
            'GEORADIUSBYMEMBER' => GeoRadius::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
