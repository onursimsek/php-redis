<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

class Version320 implements Version
{
    public function addedCommands(): array
    {
        return [
            // Strings
            'APPEND' => ['key', 'value'],
            'BITCOUNT' => ['key', 'start', 'end'],
            'BITFIELD' => [],
            'BITOP' => ['operation', 'destination_key', 'source_keys'],
            'BITPOS' => ['key', 'bit', 'start', 'end'],
            'DECR' => [
                'key' => ['required', 'string'],
            ],
            'DECRBY' => [
                'key' => ['required', 'string'],
                'decriment' => ['required', 'integer'],
            ],
            'GET' => ['key' => ['required', 'string'],],
            'GETBIT' => ['key', 'offset'],
            'GETRANGE' => [
                'key' => ['required', 'string'],
                'start' => ['required', 'integer'],
                'end' => ['required', 'integer'],
            ],
            'GETSET' => ['key', 'value'],
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
            'MGET' => [
                '*' => ['required', 'string'],
            ],
            'MSET' => [
                '*' => ['required', 'array'],
            ],
            'MSETNX' => ['key', 'value'],
            'PSETEX' => ['key', 'milliseconds', 'value'],
            'SET' => [
                'key' => ['required', 'string'],
                'value' => ['required', 'string'],
                'expire_type' => ['enum' => ['EX', 'PX']],
                'expire_time' => ['integer'],
                'exist' => ['enum' => ['NX', 'XX']],
            ],
            'SETBIT' => ['key', 'offset', 'value'],
            'SETEX' => ['key', 'seconds', 'value'],
            'SETNX' => ['key', 'value'],
            'SETRANGE' => [
                'key' => ['required', 'string'],
                'start' => ['required', 'integer'],
                'value' => ['required', 'string'],
            ],
            'STRLEN' => [
                'key' => ['required', 'string'],
            ],

        ];
    }

    public function deletedCommands(): array
    {
        return [];
    }
}