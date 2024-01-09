<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use Generator;
use PhpRedis\Connections\Connection;
use PhpRedis\Enums\Protocol;
use PhpRedis\Exceptions\IOException;
use PhpRedis\Exceptions\RespException;

class ResponseUnserializer implements UnserializationProtocol
{
    protected int $stopperCount = 0;

    public function unserialize(Generator $response): bool|array|int|string|null
    {
        $payload = substr($response->current(), 1);

        return match ($response->current()[0]) {
            Protocol::SimpleStringFirstByte->value => $this->simpleStringProtocol($payload),
            Protocol::BulkStringFirstByte->value => $this->bulkStringProtocol($response),
            Protocol::IntegerFirstByte->value => $this->integerProtocol($payload),
            Protocol::ArrayFirstByte->value => $this->arrayProtocol($response),
            Protocol::ErrorFirstByte->value => throw new RespException($this->errorProtocol($payload)),
            default => throw new IOException('Unknown protocol response: ' . $response->current()),
        };
    }

    private function simpleStringProtocol(string $response): bool|string
    {
        $response = $this->discardCRLF($response);
        if ($response == Protocol::SuccessResponse->value) {
            return true;
        }

        return $response;
    }

    private function discardCRLF(string $string): string
    {
        return preg_replace('/' . Protocol::CRLF->value . '$/', '', $string);
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
            if (strlen($data) === $totalBytes + 2 && ! $this->stop($response)) {
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
        switch ($totalRow) {
            case -1:
                return null;
            case 0:
                return [];
        }

        $this->stopperCount++;

        $data = [];
        while ($response->valid()) {
            $response->next();
            $data[] = $this->unserialize($response);
            if (count($data) === $totalRow && ! $this->stop($response)) {
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
