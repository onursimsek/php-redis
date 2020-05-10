<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

interface Version
{
    public function addedCommands(): array;

    public function deletedCommands(): array;
}