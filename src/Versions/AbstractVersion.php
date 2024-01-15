<?php

namespace PhpRedis\Versions;

abstract class AbstractVersion implements Version
{
    public function __construct(protected ?Version $version)
    {
    }

    abstract protected function push(): array;

    abstract protected function pull(): array;

    public function toArray(): array
    {
        return array_diff(
            array_merge(
                $this->version?->toArray() ?? [],
                $this->push()
            ),
            $this->pull()
        );
    }
}
