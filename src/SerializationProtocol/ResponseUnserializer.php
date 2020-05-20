<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use PhpRedis\Exceptions\IOException;
use PhpRedis\Exceptions\RespException;

class ResponseUnserializer implements UnserializationProtocol
{
    public function unserialize(\Generator $response)
    {
        $payload = substr($response->current(), 1);
        switch ($response->current()[0]) {
            case self::SIMPLE_STRING_FIRST_BYTE:
                return $this->simpleStringProtocol($payload);
                break;
            case self::BULK_STRING_FIRST_BYTE:
                return $this->bulkStringProtocol($response);
                break;
            case self::INTEGER_FIRST_BYTE:
                return $this->integerProtocol($payload);
                break;
            case self::ARRAY_FIRST_BYTE:
                return $this->arrayProtocol($response);
                break;
            case self::ERROR_FIRST_BYTE:
                throw new RespException($this->errorProtocol($payload));
                break;
            default:
                throw new IOException('Unknown protocol response: ' . $response->current());
                break;
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

    private function integerProtocol(string $response): int
    {
        return (int)$this->discardCRLF($response);
    }

    private function bulkStringProtocol(\Generator $response)
    {
        $totalBytes = (int)substr($response->current(), 1, -2);
        if ($totalBytes === -1) {
            return null;
        }

        $data = '';
        while ($response->valid()) {
            $response->next();
            $data .= $response->current();
            if (strlen($data) === $totalBytes + 2) {
                $response->send('stop');
            }
        }

        return $this->discardCRLF($data);
    }

    private function arrayProtocol(\Generator $response)
    {
        $totalRow = (int)substr($response->current(), 1, -2);
        if ($totalRow === -1) {
            return null;
        }

        $data = [];
        while ($response->valid()) {
            $response->next();
            $data[] = $this->unserialize(
                (static function () use ($response) {
                    if ($response->current()[0] !== self::BULK_STRING_FIRST_BYTE) {
                        yield $response->current();
                    }

                    yield $response->current();
                    $response->next();
                    yield $response->current();
                })()
            );
            if (count($data) === $totalRow) {
                $response->send('stop');
            }
        }

        return $data;
    }

    private function errorProtocol(string $response): string
    {
        return $this->discardCRLF($response);
    }

    private function discardCRLF(string $string)
    {
        return preg_replace('/' . self::CRLF . '$/', '', $string);
    }
}