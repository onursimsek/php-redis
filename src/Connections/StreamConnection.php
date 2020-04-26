<?php

namespace PhpRedis\Connections;

use PhpRedis\Configurations\Parameter;
use PhpRedis\Exceptions\ConnectionException;

class StreamConnection
{
    /**
     * @var resource
     */
    private $resource;

    /**
     * @var Parameter
     */
    private $parameters;

    public function connect(Parameter $parameter)
    {
        if ($this->isConnected()) {
            return true;
        }

        if (!$this->resource = stream_socket_client($parameter->getConnectionString(), $errNo, $errStr)) {
            throw new ConnectionException($errStr, $errNo);
        }

        return true;
    }

    public function disconnect()
    {
        return stream_socket_shutdown($this->resource, STREAM_SHUT_RDWR) && $this->resource = null;
    }

    public function isConnected()
    {
        return !!$this->resource;
    }
}
