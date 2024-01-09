<?php

declare(strict_types=1);

namespace PhpRedis\Parameters;

final class ClientKill
{
    public function __construct(
        private readonly string $value,
        private readonly string $type = 'ADDR',
        private readonly bool $skipMe = true
    ) {
    }

    public function toArray(): array
    {
        return [$this->type, $this->value, 'SKIPME', $this->skipMe ? 'yes' : 'no'];
    }
}
