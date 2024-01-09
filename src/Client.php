<?php

declare(strict_types=1);

namespace PhpRedis;

interface Client
{
    public function isConnected(): bool;

    public function connect(): bool;

    public function disconnect(): bool;

    public function getRedisVersion(): string;

    public function getLibraryRedisVersion(): string;

    public function __call(string $name, array $arguments);
}
