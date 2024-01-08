<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use PhpRedis\Commands\Command;

interface SerializationProtocol extends Protocol
{
    public function serialize(Command $command): string;
}
