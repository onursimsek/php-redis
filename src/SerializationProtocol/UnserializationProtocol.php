<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use Generator;

interface UnserializationProtocol extends Protocol
{
    public function unserialize(Generator $response);
}
