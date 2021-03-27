<?php

declare(strict_types=1);

namespace PhpRedis;

interface Client
{
    public const REDIS_VERSION_100 = '1.0';
    public const REDIS_VERSION_120 = '1.2';
    public const REDIS_VERSION_200 = '2.0';
    public const REDIS_VERSION_220 = '2.2';
    public const REDIS_VERSION_240 = '2.4';
    public const REDIS_VERSION_260 = '2.6';
    public const REDIS_VERSION_280 = '2.8';
    public const REDIS_VERSION_300 = '3.0';
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
