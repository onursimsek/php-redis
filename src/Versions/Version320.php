<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version320 implements Version
{
    public function addedCommands(): array
    {
        return [
            // Strings
            'SET' => [
                'key' => ['required', 'string'],
                'value' => ['required', 'string'],
                'expire_type' => ['enum:EX,PX'],
                'expire_time' => ['integer'],
                'exist' => ['enum:NX,XX'],
            ],
            'GET' => [
                'key' => ['required', 'string'],
            ],
            'INCR' => [
                'key' => ['required', 'string'],
            ],
            'INCRBY' => [
                'key' => ['required', 'string'],
                'increment' => ['required', 'integer'],
            ],
            'INCRBYFLOAT' => [
                'key' => ['required', 'string'],
                'increment' => ['required', 'float'],
            ],
            'DECR' => [
                'key' => ['required', 'string'],
            ],
            'DECRBY' => [
                'key' => ['required', 'string'],
                'decriment' => ['required', 'integer'],
            ],
        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}