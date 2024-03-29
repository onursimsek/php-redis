<?php

declare(strict_types=1);

namespace PhpRedis\Connections;

use Generator;
use PhpRedis\Commands\Command;
use PhpRedis\Configurations\Parameter;
use PhpRedis\Enums\Protocol;
use PhpRedis\Exceptions\ConnectionException;
use PhpRedis\Exceptions\IOException;
use PhpRedis\Exceptions\PhpRedisException;
use PhpRedis\SerializationProtocol\RequestSerializer;
use PhpRedis\SerializationProtocol\ResponseUnserializer;

class StreamConnection implements Connection
{
    /**
     * @var resource
     */
    private $resource;

    private array $info = [];

    public function connect(Parameter $parameter): bool
    {
        try {
            $this->resource = stream_socket_client($parameter->getConnectionString(), $errorCode, $errorMessage);
        } catch (\Throwable $e) {
            throw new ConnectionException($errorMessage, $errorCode);
        }

        return true;
    }

    public function disconnect(): bool
    {
        return stream_socket_shutdown($this->resource, STREAM_SHUT_RDWR) && $this->resource = null;
    }

    public function isConnected(): bool
    {
        return (bool)$this->resource;
    }

    public function executeCommand(Command $command): array|bool|int|string|null
    {
        return $this->write((string)$command)
            ->readResponse();
    }

    public function rawCommand(array $command): array|bool|int|string|null
    {
        return $this->write((new RequestSerializer())->serialize($command))
            ->readResponse();
    }

    protected function write(string $string): static
    {
        $written = fwrite($this->resource, $string);
        if ($written !== strlen($string)) {
            throw new IOException('All bytes could not be written');
        }

        return $this;
    }

    public function readResponse(): array|bool|int|string|null
    {
        return (new ResponseUnserializer())->unserialize($this->read());
    }

    public function read(): Generator
    {
        while (true) {
            $data = yield fgets($this->resource);

            if ($data == Connection::STOP_KEYWORD) {
                break;
            }
        }
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
        $activeSection = null;
        $info = [];
        foreach (explode(Protocol::CRLF->value, $response) as $row) {
            if (! $row) {
                continue;
            }

            $columns = explode(':', $row, 2);
            if (count($columns) == 1 && str_starts_with($columns[0], '#')) {
                $activeSection = strtolower(substr($row, 2));
                continue;
            }

            if (! $activeSection) {
                throw new PhpRedisException('Section not found');
            }

            $info[$activeSection][$columns[0]] = $columns[1];
        }

        return $info;
    }
}
