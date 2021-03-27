<?php

namespace PhpRedis\Tests\SerializationProtocol;

use PhpRedis\Exceptions\IOException;
use PhpRedis\Exceptions\RespException;
use PhpRedis\SerializationProtocol\ResponseUnserializer;
use PHPUnit\Framework\TestCase;

class ResponseUnserializerTest extends TestCase
{
    /**
     * @var ResponseUnserializer
     */
    protected $unserializer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->unserializer = new ResponseUnserializer();
    }

    public function test_unserialize_success_response()
    {
        self::assertTrue($this->unserializer->unserialize($this->dataAsGenerator("+OK\r\n")));
    }

    public function test_unserialize_simple_string_response()
    {
        self::assertEquals('foo', $this->unserializer->unserialize($this->dataAsGenerator("+foo\r\n")));
    }

    public function test_unserialize_bulk_string()
    {
        self::assertEquals('bar', $this->unserializer->unserialize($this->dataAsGenerator("$3\r\nbar\r\n")));

        self::assertNull($this->unserializer->unserialize($this->dataAsGenerator("$-1\r\n")));
    }

    public function test_unserialize_integer_response()
    {
        self::assertEquals(123, $this->unserializer->unserialize($this->dataAsGenerator(":123\r\n")));
    }

    public function test_unserialize_array_response()
    {
        $arguments = $this->dataAsGenerator("*2\r\n$3\r\nfoo\r\n$3\r\nbar\r\n");
        $expected = ['foo', 'bar'];

        self::assertEquals($expected, $this->unserializer->unserialize($arguments));

        $arguments = $this->dataAsGenerator("*2\r\n:100\r\n:200\r\n");
        $expected = [100, 200];

        self::assertEquals($expected, $this->unserializer->unserialize($arguments));

        $arguments = $this->dataAsGenerator("*3\r\n$3\r\nfoo\r\n:100\r\n+A\r\n");
        $expected = ['foo', 100, 'A'];

        self::assertEquals($expected, $this->unserializer->unserialize($arguments));

        $arguments = $this->dataAsGenerator("*2\r\n$3\r\nfoo\r\n*2\r\n:100\r\n+A\r\n");
        $expected = ['foo', [100, 'A']];

        self::assertEquals($expected, $this->unserializer->unserialize($arguments));

        $arguments = $this->dataAsGenerator("*-1\r\n");

        self::assertNull($this->unserializer->unserialize($arguments));

        $arguments = $this->dataAsGenerator("*0\r\n");

        self::assertEquals([], $this->unserializer->unserialize($arguments));
    }

    public function test_unserialize_error_response()
    {
        self::expectException(RespException::class);

        $this->unserializer->unserialize($this->dataAsGenerator("-ERR wrong command\r\n"));
    }

    public function test_unserialize_unknown_response()
    {
        self::expectException(IOException::class);

        $this->unserializer->unserialize($this->dataAsGenerator("/OK\r\n"));
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
