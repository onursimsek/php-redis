<?php

namespace PhpRedis\Connections;

use PhpRedis\Commands\Command;
use PhpRedis\Configurations\Parameter;

interface Connection
{
    public function connect(Parameter $parameter);

    public function disconnect();

    public function isConnected();

    public function executeCommand(Command $command);

    public function readResponse();
}