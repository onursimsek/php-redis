<?php

namespace PhpRedis\Connections;

use PhpRedis\Commands\Command;
use PhpRedis\Configurations\Parameter;

interface Connection
{
    const STOP_KEYWORD = 'stop';

    public function connect(Parameter $parameter): bool;

    public function disconnect(): bool;

    public function isConnected(): bool;

    public function executeCommand(Command $command);

    public function readResponse();

    public function getInfo(string $section = null): array;
}
