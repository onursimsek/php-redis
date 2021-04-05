<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Keys\Scan;
use PhpRedis\Commands\Sets\SScan;

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
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
