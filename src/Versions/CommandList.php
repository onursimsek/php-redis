<?php

namespace PhpRedis\Versions;

use PhpRedis\Enums\Version as VersionEnum;

class CommandList
{
    public function __construct(private readonly string $version)
    {
    }

    private function collectCommands(array $versions): Version
    {
        return array_reduce($versions, static function ($version, $item): Version {
            return new $item($version);
        });
    }

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
            VersionEnum::V100->value => Version100::class,
            VersionEnum::V120->value => Version120::class,
            VersionEnum::V200->value => Version200::class,
            VersionEnum::V220->value => Version220::class,
            VersionEnum::V240->value => Version240::class,
            VersionEnum::V260->value => Version260::class,
            VersionEnum::V280->value => Version280::class,
            VersionEnum::V300->value => Version300::class,
            VersionEnum::V320->value => Version320::class,
            VersionEnum::V400->value => Version400::class,
            VersionEnum::V500->value => Version500::class,
            VersionEnum::V600->value => Version600::class,
            VersionEnum::V720->value => Version720::class,
        ];
    }

    /**
     * @return class-string[]
     */
    public function toArray(): array
    {
        return $this->collectCommands($this->backwards($this->version))->toArray();
    }
}
