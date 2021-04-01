<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version120 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // Key commands
            'EXPIREAT' => $this->commandObject(),

            // List commands
            'RPOPLPUSH' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
