<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

interface Version
{
    public function added(): iterable;

    public function deleted(): iterable;
}
