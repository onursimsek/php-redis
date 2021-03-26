<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use Generator;
use PhpRedis\Connections\Connection;
use PhpRedis\Exceptions\IOException;
use PhpRedis\Exceptions\RespException;

class ResponseUnserializer implements UnserializationProtocol
{
    protected int $stopperCount = 0;

    public function unserialize(Generator $response)
    {
        $payload = substr($response->current(), 1);
        switch ($response->current()[0]) {
            case self::SIMPLE_STRING_FIRST_BYTE:
                return $this->simpleStringProtocol($payload);
            case self::BULK_STRING_FIRST_BYTE:
                return $this->bulkStringProtocol($response);
            case self::INTEGER_FIRST_BYTE:
                return $this->integerProtocol($payload);
            case self::ARRAY_FIRST_BYTE:
                return $this->arrayProtocol($response);
            case self::ERROR_FIRST_BYTE:
                throw new RespException($this->errorProtocol($payload));
            default:
                throw new IOException('Unknown protocol response: ' . $response->current());
        }
    }

    private function simpleStringProtocol(string $response)
    {
        $response = $this->discardCRLF($response);
        if ($response == self::SUCCESS_RESPONSE) {
            return true;
        }

        return $response;
    }

    private function discardCRLF(string $string): string
    {
        return preg_replace('/' . self::CRLF . '$/', '', $string);
    }

    private function bulkStringProtocol(Generator $response): ?string
    {
        $totalBytes = (int)substr($response->current(), 1, -2);
        if ($totalBytes === -1) {
            return null;
        }

        $this->stopperCount++;

        $data = '';
        while ($response->valid()) {
            $response->next();
            $data .= $response->current();
            if (strlen($data) === $totalBytes + 2 && !$this->stop($response)) {
                break;
            }
        }

        return $this->discardCRLF($data);
    }

    private function stop(Generator $response): bool
    {
        $this->stopperCount--;
        if ($this->stopperCount == 0) {
            $response->send(Connection::STOP_KEYWORD);

            return true;
        }

        return false;
    }

    private function integerProtocol(string $response): int
    {
        return (int)$this->discardCRLF($response);
    }

    private function arrayProtocol(Generator $response): ?array
    {
        $totalRow = (int)substr($response->current(), 1, -2);
        if ($totalRow === -1) {
            return null;
        }

        $this->stopperCount++;

        $data = [];
        while ($response->valid()) {
            $response->next();
            $data[] = $this->unserialize($response);
            if (count($data) === $totalRow && !$this->stop($response)) {
                break;
            }
        }

        return $data;
    }

    private function errorProtocol(string $response): string
    {
        return $this->discardCRLF($response);
    }
}
