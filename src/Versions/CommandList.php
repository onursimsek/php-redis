<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Client;

class CommandList
{
    /**
     * @var array Command list
     */
    private $commandList = [];

    public function __construct(string $version)
    {
        $this->commandList = $this->collectCommands($this->backwards($version));
    }

    /**
     * Available Redis versions
     *
     * @return array|string[]
     */
    private function versions(): array
    {
        return [
            Client::REDIS_VERSION_320 => Version320::class,
        ];
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
                array_merge($commandList, $version->addedCommands()),
                static function ($key) use ($version) {
                    return !in_array($key, $version->deletedCommands());
                },
                ARRAY_FILTER_USE_KEY
            );
        }

        return $commandList;
    }

    /**
     * @return mixed
     */
    public function toArray(): array
    {
        return $this->commandList;
    }
}