<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Connections\ClientGetName;
use PhpRedis\Commands\Connections\ClientSetName;

class Version260 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'BITCOUNT' => $this->commandObject(),
            'BITOP' => $this->commandObject(),
            'INCRBYFLOAT' => $this->commandObject(),
            'PSETEX' => $this->commandObject(),
            'SET' => $this->commandObject(),

            // Connection commands
            'CLIENTGETNAME' => $this->commandObject(ClientGetName::class),
            'CLIENTSETNAME' => $this->commandObject(ClientSetName::class),

            // Key commands
            'DUMP' => $this->commandObject(),
            'PEXPIRE' => $this->commandObject(),
            'PEXPIREAT' => $this->commandObject(),
            'PTTL' => $this->commandObject(),
            'RESTORE' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
