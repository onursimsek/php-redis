<?php

declare(strict_types=1);

namespace PhpRedis\SerializationProtocol;

use PhpRedis\Exceptions\IOException;

class ResponseUnserializer implements UnserializationProtocol
{
    public function unserialize(\Generator $response)
    {
        $payload = substr($response->current(), 1, -2);
        switch ($response->current()[0]) {
            case self::SIMPLE_STRING_FIRST_BYTE:
                /**
                 * https://redis.io/topics/protocol#resp-simple-strings
                 */
                if ($payload == self::SUCCESS_RESPONSE) {
                    return true;
                }

                return $payload;
                break;
            case self::BULK_STRING_FIRST_BYTE:
                /**
                 * https://redis.io/topics/protocol#resp-bulk-strings
                 */
                $total = (int)$payload;
                if ($total === -1) {
                    return;
                }

                $data = '';
                while ($response->valid()) {
                    $response->next();
                    $data .= $response->current();
                    if (strlen($data) === $total + 2) {
                        $response->send('stop');
                    }
                }

                return $this->discardCRLF($data);
                break;
            case self::INTEGER_FIRST_BYTE:
                return $this->discardCRLF($payload);
                break;
            default:
                throw new IOException('Unknown protocol response: ' . $response->current());
                break;
        }
    }

    private function discardCRLF(string $string)
    {
        return preg_replace('/' . self::EOL . '/', '', $string);
    }
}