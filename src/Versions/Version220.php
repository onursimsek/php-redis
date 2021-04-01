<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version220 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'GETBIT' => $this->commandObject(),
            'SETBIT' => $this->commandObject(),
            'SETRANGE' => $this->commandObject(),
            'STRLEN' => $this->commandObject(),

            // Key commands
            'OBJECT' => $this->commandObject(),
            'PERSIST' => $this->commandObject(),

            // List commands
            'BRPOPLPUSH' => $this->commandObject(),
            'LINSERT' => $this->commandObject(),
            'LPUSHX' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
