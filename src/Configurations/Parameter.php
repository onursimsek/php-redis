<?php

namespace PhpRedis\Configurations;

interface Parameter
{
    public function getConnectionString(): string;
}
