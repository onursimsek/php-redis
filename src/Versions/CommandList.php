<?php

declare(strict_types=1);

namespace PhpRedis\Versions;

use PhpRedis\Commands\Command;
use PhpRedis\Enums\Version;

class CommandList
{
    /**
     * @var Command[] Command list
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
                    return ! in_array($key, $version->deleted());
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
            Version::V100->value => Version100::class,
            Version::V120->value => Version120::class,
            Version::V200->value => Version200::class,
            Version::V220->value => Version220::class,
            Version::V240->value => Version240::class,
            Version::V260->value => Version260::class,
            Version::V280->value => Version280::class,
            Version::V300->value => Version300::class,
            Version::V320->value => Version320::class,
            Version::V400->value => Version400::class,
            Version::V500->value => Version500::class,
            Version::V600->value => Version600::class,
            Version::V720->value => Version720::class,
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
