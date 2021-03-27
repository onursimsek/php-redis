<?php

declare(strict_types=1);

namespace PhpRedis\Traits;

use PhpRedis\SerializationProtocol\RequestSerializer;

trait Stringify
{
    public function __toString(): string
    {
        return (new RequestSerializer())->serialize($this);
    }
}
