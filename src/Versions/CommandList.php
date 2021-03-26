<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Client;

class CommandList
{
    /**
     * @var array Command list
     */
    private array $commandList = [];

    public function __construct(string $version)
    {
        $this->commandList = $this->collectCommands($this->backwards($version));
    }

    /**
     * Collect and remove commands
     *
     * @param array $versions
     * @return array
     */
    private function collectCommands(array $versions): array
    {
        $commandList = [];
        foreach ($versions as $versionClassName) {
            /** @var Version $version */
            $version = new $versionClassName();

            $commandList = array_filter(
                array_merge($commandList, $version->added()),
                static function ($key) use ($version) {
                    return !in_array($key, $version->deleted());
                },
                ARRAY_FILTER_USE_KEY
            );
        }

        return $commandList;
    }

    /**
     * Active Redis version and backward version
     *
     * @param string $version
     * @return array
     */
    private function backwards(string $version): array
    {
        return array_filter(
            $this->versions(),
            static function ($key) use ($version) {
                return $key <= $version;
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * Available Redis versions
     *
     * @return array|string[]
     */
    private function versions(): array
    {
        return [
            Client::REDIS_VERSION_100 => Version100::class,
            Client::REDIS_VERSION_120 => Version120::class,
            Client::REDIS_VERSION_200 => Version200::class,
            Client::REDIS_VERSION_220 => Version220::class,
            Client::REDIS_VERSION_240 => Version240::class,
            Client::REDIS_VERSION_260 => Version260::class,
            Client::REDIS_VERSION_280 => Version280::class,
            Client::REDIS_VERSION_300 => Version300::class,
            Client::REDIS_VERSION_320 => Version320::class,
            Client::REDIS_VERSION_400 => Version400::class,
            Client::REDIS_VERSION_500 => Version500::class,
            Client::REDIS_VERSION_600 => Version600::class,
        ];
    }

    /**
     * @return mixed
     */
    public function toArray(): array
    {
        return $this->commandList;
    }
}
