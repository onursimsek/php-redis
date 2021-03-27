<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version200 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // String commands
            'APPEND' => $this->commandObject(),
            'SETEX' => $this->commandObject(),

            // Hash commands
            'HDEL' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
