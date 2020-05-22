<?php

declare(strict_types=1);

namespace PhpRedis;

interface Client
{
    public const REDIS_VERSION_320 = '3.2';
    public const REDIS_VERSION_400 = '4.0';
    public const REDIS_VERSION_500 = '5.0';
    public const REDIS_VERSION_600 = '6.0';

    public function isConnected(): bool;

    public function connect(): bool;

    public function disconnect(): bool;

    public function getRedisVersion(): string;

    public function getLibraryRedisVersion(): string;

    public function __call(string $name, array $arguments);
}