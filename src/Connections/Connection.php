<?php

namespace PhpRedis\Connections;

interface Connection
{
    public function connect();

    public function disconnect();

    public function isConnected();

    public function read();

    public function write();
}
