<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use PhpRedis\Commands\Command;

/**
 * Class RequestSerializer
 *
 * @link https://redis.io/topics/protocol
 * @author Onur Şimşek <posta@onursimsek.com>
 */
class RequestSerializer implements SerializationProtocol
{
    /**
     * @param mixed $data
     * @return string
     */
    public function serialize($data): string
    {
        switch (true) {
            case $data instanceof Command:
                return $this->serializeCommand($data);
            case is_array($data):
                return $this->arrayProtocol($data);
            case is_string($data):
                return $this->bulkStringProtocol($data);
        }

        throw new \UnexpectedValueException(
            'This type (\'' . gettype($data) . '\') is not supported from REDIS Protocol'
        );
    }

    /**
     * @param Command $command
     * @return string
     */
    private function serializeCommand(Command $command): string
    {
        return $this->arrayProtocol($command->toArray());
    }

    /**
     * @param array $array
     * @return string
     */
    private function arrayProtocol(array $array): string
    {
        $array = $this->flattenArray($array);
        return self::ARRAY_FIRST_BYTE . count($array) . self::CRLF . array_reduce(
                $array,
                function (?string $carry, string $item): string {
                    return $carry . $this->bulkStringProtocol($item);
                }
            );
    }

    /**
     * @param string $string
     * @return string
     */
    private function bulkStringProtocol(string $string): string
    {
        return self::BULK_STRING_FIRST_BYTE . strlen($string) . self::CRLF . $string . self::CRLF;
    }

    /**
     * @param array $arguments
     * @return array
     */
    private function flattenArray(array $arguments): array
    {
        $result = [];
        foreach ($arguments as $key => $item) {
            if (is_string($key)) {
                $result[] = $key;
            }

            if (!is_array($item)) {
                $result[] = $item;
            } else {
                $result = array_merge($result, $this->flattenArray($item));
            }
        }

        return $result;
    }
}