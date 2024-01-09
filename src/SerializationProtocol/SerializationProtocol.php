<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

interface SerializationProtocol extends Protocol
{
    public function serialize(mixed $data): string;
}
