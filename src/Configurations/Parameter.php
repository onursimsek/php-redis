<?php

namespace PhpRedis\Configurations;

interface Parameter
{
    public function setHosts(array $hosts);

    public function setOptions(array $options);

    public function getConnectionString(): string;
}