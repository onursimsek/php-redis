<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version300 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            // Key commands
            'WAIT' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
