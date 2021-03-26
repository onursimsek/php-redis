<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version400 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [
            'UNLINK' => $this->commandObject(),
        ];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
