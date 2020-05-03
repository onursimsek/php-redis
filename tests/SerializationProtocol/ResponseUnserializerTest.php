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

        $this->assertTrue($unserializer->unserialize("+OK\r\n"));
    }

    public function test_unserialize_simple_string_response()
    {
        $unserializer = $this->getUnserializer();

        $this->assertEquals('foo', $unserializer->unserialize("+foo\r\n"));
    }

    public function test_unserialize_unknown_response()
    {
        $unserializer = $this->getUnserializer();

        $this->expectException(IOException::class);

        $unserializer->unserialize("/OK\r\n");
    }

    private function getUnserializer()
    {
        return new ResponseUnserializer();
    }
}