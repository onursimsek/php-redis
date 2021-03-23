<?php

declare(strict_types=1);

namespace PhpRedis\Connections;

use PhpRedis\Commands\Command;
use PhpRedis\Configurations\Parameter;
use PhpRedis\Exceptions\ConnectionException;
use PhpRedis\Exceptions\IOException;
use PhpRedis\Exceptions\PhpRedisException;
use PhpRedis\SerializationProtocol\Protocol;
use PhpRedis\SerializationProtocol\RequestSerializer;
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

    /**
     * @var array
     */
    private $info = [];

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

    public function rawCommand(array $command)
    {
        return $this->write((new RequestSerializer())->serialize($command))
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

    public function getInfo(string $section = null): array
    {
        if ($section && array_key_exists($section, $this->info)) {
            return $this->info[$section];
        }

        if ($this->info) {
            return $this->info;
        }

        $this->info = $this->parseInfoResponse($this->rawCommand($section ? ['INFO', $section] : ['INFO']));

        return $section ? $this->info[$section] : $this->info;
    }

    private function parseInfoResponse(string $response): array
    {
        $activeSection = '';
        $info = [];
        foreach (explode(Protocol::CRLF, $response) as $row) {
            if (!$row) {
                continue;
            }

            if ($row[0] == '#') {
                $activeSection = strtolower(substr($row, 2));
                continue;
            }

            if (!$activeSection) {
                throw new PhpRedisException('Section not found');
            }

            [$key, $value] = explode(':', $row);
            if (!$key) {
                continue;
            }

            $info[$activeSection][$key] = $value;
        }

        return $info;
    }
}
