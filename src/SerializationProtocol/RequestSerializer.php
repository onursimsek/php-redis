<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use PhpRedis\Commands\Command;

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
                break;
            case is_array($data):
                return $this->arrayProtocol($data);
                break;
            case is_string($data):
                return $this->bulkStringProtocol($data);
                break;
        }

        throw new \UnexpectedValueException(
            sprintf('This type (%s) is not supported from REDIS Protocol', gettype($data))
        );
    }

    /**
     * @param Command $command
     * @return string
     */
    private function serializeCommand(Command $command): string
    {
        return $this->arrayProtocol(array_merge([$command->getCommand()], $command->getArguments()));
    }

    /**
     * @param array $array
     * @return string
     */
    private function arrayProtocol(array $array): string
    {
        return self::ARRAY_FIRST_BYTE . count($array) . self::EOL . array_reduce(
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
        return self::BULK_STRING_FIRST_BYTE . strlen($string) . self::EOL . $string . self::EOL;
    }
}