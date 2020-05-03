<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use PhpRedis\Exceptions\IOException;

class ResponseUnserializer implements UnserializationProtocol
{
    public function unserialize(string $response)
    {
        $payload = explode("\r\n", substr($response, 1));
        switch ($response[0]) {
            case self::SIMPLE_STRING_FIRST_BYTE:
                if ($payload[0] == self::SUCCESS_RESPONSE) {
                    return true;
                }

                return $payload[0];
                break;
            default:
                throw new IOException('Unknown protocol response: ' . $response);
                break;
        }
    }
}