<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Keys\Scan;
use PhpRedis\Commands\Sets\SScan;
use PhpRedis\Commands\SortedSets\ZRevRangeByLex;
use PhpRedis\Commands\SortedSets\ZScan;

class Version280 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'BITPOS' => $this->commandObject(),

            // Set commands
            'SSCAN' => $this->commandObject(SScan::class),

            // Key commands
            'SCAN' => $this->commandObject(Scan::class),

            // Hash commands
            'HSCAN' => $this->commandObject(),

            // Sorted set commands
            'ZLEXCOUNT' => $this->commandObject(),
            'ZRANGEBYLEX' => $this->commandObject(),
            'ZREMRANGEBYLEX' => $this->commandObject(),
            'ZREVRANGEBYLEX' => $this->commandObject(ZRevRangeByLex::class),
            'ZSCAN' => $this->commandObject(ZScan::class),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
