<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version600 implements Version
{
    public function addedCommands(): array
    {
        return [
            // Strings
            'SET' => [
                'key' => ['required', 'string'],
                'value' => ['required', 'string'],
                'expire_type' => ['enum' => ['EX', 'PX']],
                'expire_time' => ['integer'],
                'exist' => ['enum' => ['NX', 'XX']],
                'keep_ttl' => [],
            ],
            'STRALGO' => [],
        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}