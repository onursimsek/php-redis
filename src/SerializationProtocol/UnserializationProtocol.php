<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

interface UnserializationProtocol extends Protocol
{
    public function unserialize(\Generator $response);
}
