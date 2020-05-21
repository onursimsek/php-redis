<?php

declare(strict_types=1);

namespace PhpRedis\Connections;

use PhpRedis\Commands\Command;
use PhpRedis\Configurations\Parameter;
use PhpRedis\Exceptions\ConnectionException;
use PhpRedis\Exceptions\IOException;
use PhpRedis\SerializationProtocol\ResponseUnserializer;

class StreamConnection implements Connection
{
    /**
     * @var resource
     */
    private $resource;

    /**
     * @var Parameter
     */
    private $parameters;

    public function connect(Parameter $parameter): bool
    {
        try {
            $this->resource = stream_socket_client($parameter->getConnectionString(), $errNo, $errStr);

            return true;
        } catch (\Exception $e) {
            throw new ConnectionException($e->getMessage(), $e->getCode());
        }
    }

    public function disconnect(): bool
    {
        return stream_socket_shutdown($this->resource, STREAM_SHUT_RDWR) && $this->resource = null;
    }

    public function isConnected(): bool
    {
        return (bool)$this->resource;
    }

    public function executeCommand(Command $command)
    {
        return $this->write((string)$command)
            ->readResponse();
    }

    /**
     * @param string $string
     * @return $this
     * @throws IOException
     */
    protected function write(string $string)
    {
        $written = fwrite($this->resource, $string);
        if ($written !== strlen($string)) {
            throw new IOException('All bytes could not be written');
        }

        return $this;
    }

    public function readResponse()
    {
        return (new ResponseUnserializer())->unserialize($this->read());
    }

    public function read(): \Generator
    {
        while (true) {
            $data = yield fgets($this->resource);

            if ($data == 'stop') {
                break;
            }
        }

        return;
    }
}