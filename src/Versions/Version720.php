<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version720 implements Version
{
    use GenericCommandObject;

    public function added(): iterable
    {
        return [];
    }

    public function deleted(): iterable
    {
        return [];
    }
}
