<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version400 implements Version
{
    public function addedCommands(): array
    {
        return [];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}