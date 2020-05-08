<?php

declare(strict_types=1);

namespace PhpRedis;

use PhpRedis\Commands\Command;
use PhpRedis\Configurations\Parameter;
use PhpRedis\Connections\Connection;
use PhpRedis\Connections\StreamConnection;

class PhpRedis
{
    /**
     * @var Parameter
     */
    private $connectionParameter;

    /**
     * @var Connection
     */
    private $connection = null;

    public function setConnectionParameter(Parameter $parameter)
    {
        $this->connectionParameter = $parameter;
        return $this;
    }

    public function isConnected()
    {
        return !!$this->connection;
    }

    public function connect()
    {
        if (!$this->isConnected()) {
            $this->connection = new StreamConnection();
        }

        return $this->connection->connect($this->connectionParameter);
    }

    public function disconnect()
    {
        return $this->connection->disconnect();
    }

    public function executeCommand(Command $command)
    {
        return $this->connection->executeCommand($command);
    }
}