<?php

namespace PhpRedis\Tests\SerializationProtocol;

use PhpRedis\Exceptions\IOException;
use PhpRedis\SerializationProtocol\ResponseUnserializer;
use PHPUnit\Framework\TestCase;

class ResponseUnserializerTest extends TestCase
{
    public function test_unserialize_success_response()
    {
        $unserializer = $this->getUnserializer();

        self::assertTrue($unserializer->unserialize($this->dataAsGenerator("+OK\r\n")));
    }

    public function test_unserialize_simple_string_response()
    {
        $unserializer = $this->getUnserializer();

        self::assertEquals('foo', $unserializer->unserialize($this->dataAsGenerator("+foo\r\n")));
    }

    public function test_unserialize_bulk_string()
    {
        $unserializer = $this->getUnserializer();

        self::assertEquals('bar', $unserializer->unserialize($this->dataAsGenerator("$3\r\nbar\r\n")));
    }

    public function test_unserialize_null_bulk_string()
    {
        $unserializer = $this->getUnserializer();

        self::assertEmpty($unserializer->unserialize($this->dataAsGenerator("$-1\r\n")));
    }

    public function test_unserialize_integer_response()
    {
        $unserializer = $this->getUnserializer();

        self::assertEquals(123, $unserializer->unserialize($this->dataAsGenerator(":123\r\n")));
    }

    public function test_unserialize_unknown_response()
    {
        $unserializer = $this->getUnserializer();

        self::expectException(IOException::class);

        $unserializer->unserialize($this->dataAsGenerator("/OK\r\n"));
    }

    private function getUnserializer()
    {
        return new ResponseUnserializer();
    }

    private function dataAsGenerator($data)
    {
        $lines = explode("\r\n", $data);
        array_pop($lines);
        foreach ($lines as $line) {
            yield $line . "\r\n";
        }
    }
}