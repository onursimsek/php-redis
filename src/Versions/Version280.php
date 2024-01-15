<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\GenericCommand;
use PhpRedis\Commands\Keys\Scan;
use PhpRedis\Commands\Sets\SScan;
use PhpRedis\Commands\SortedSets\ZRevRangeByLex;
use PhpRedis\Commands\SortedSets\ZScan;

class Version280 extends AbstractVersion
{
    protected function push(): array
    {
        return [
            // String commands
            'BITPOS' => GenericCommand::class,

            // Set commands
            'SSCAN' => SScan::class,

            // Key commands
            'SCAN' => Scan::class,

            // Hash commands
            'HSCAN' => GenericCommand::class,

            // Sorted set commands
            'ZLEXCOUNT' => GenericCommand::class,
            'ZRANGEBYLEX' => GenericCommand::class,
            'ZREMRANGEBYLEX' => GenericCommand::class,
            'ZREVRANGEBYLEX' => ZRevRangeByLex::class,
            'ZSCAN' => ZScan::class,
        ];
    }

    protected function pull(): array
    {
        return [];
    }
}
