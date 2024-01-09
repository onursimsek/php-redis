<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use PhpRedis\Commands\Command;
use PhpRedis\Enums\Protocol;
use PhpRedis\Helpers\Arr;
use UnexpectedValueException;

/**
 * Class RequestSerializer
 *
 * @link https://redis.io/topics/protocol
 * @author Onur Şimşek <posta@onursimsek.com>
 */
class RequestSerializer implements SerializationProtocol
{
    public function serialize(mixed $data): string
    {
        return match (true) {
            $data instanceof Command => $this->serializeCommand($data),
            is_array($data) => $this->arrayProtocol($data),
            is_string($data) => $this->bulkStringProtocol($data),
            default => throw new UnexpectedValueException(
                sprintf('This type (\'%s\') is not supported from REDIS Protocol', gettype($data))
            )
        };
    }

    private function serializeCommand(Command $command): string
    {
        return $this->arrayProtocol($command->toArray());
    }

    private function arrayProtocol(array $array): string
    {
        $array = Arr::flattenWithKeys($array);

        return Protocol::ArrayFirstByte->value
            . count($array)
            . Protocol::CRLF->value
            . array_reduce(
                $array,
                fn (?string $carry, string $item): string => $carry . $this->bulkStringProtocol($item)
            );
    }

    private function bulkStringProtocol(string $string): string
    {
        return Protocol::BulkStringFirstByte->value
            . strlen($string)
            . Protocol::CRLF->value
            . $string
            . Protocol::CRLF->value;
    }
}
