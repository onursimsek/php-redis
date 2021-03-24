<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version400 implements Version
{
    public function added(): iterable
    {
        return [];
    }

    public function deleted(): iterable
    {
        return [];
    }
}