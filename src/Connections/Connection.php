<?php

namespace PhpRedis\Connections;

use PhpRedis\Commands\Command;
use PhpRedis\Configurations\Parameter;

interface Connection
{
    public function connect(Parameter $parameter): bool;

    public function disconnect(): bool;

    public function isConnected(): bool;

    public function executeCommand(Command $command);

    public function readResponse();
}