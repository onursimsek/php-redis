<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use PhpRedis\Connections\Connection;

interface UnserializationProtocol extends Protocol
{
    public function unserialize(\Generator $response);
}