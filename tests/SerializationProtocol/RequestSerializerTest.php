<?php

namespace PhpRedis\Tests\SerializationProtocol;

use PhpRedis\Commands\Command;
use PhpRedis\SerializationProtocol\RequestSerializer;
use PHPUnit\Framework\TestCase;

class RequestSerializerTest extends TestCase
{
    public function test_serialize_string()
    {
        $argument = 'PING';
        $expected = "$4\r\nPING\r\n";

        $serializer = new RequestSerializer();

        $this->assertEquals($expected, $serializer->serialize($argument));
    }

    public function test_serialize_array()
    {
        $arguments = ['key', 'value'];
        $expected = "*2\r\n$3\r\nkey\r\n$5\r\nvalue\r\n";

        $serializer = new RequestSerializer();

        $this->assertEquals($expected, $serializer->serialize($arguments));
    }

    public function test_serialize_command()
    {
        $arguments = ['key', 'value'];
        $expected = "*3\r\n$3\r\nSET\r\n$3\r\nkey\r\n$5\r\nvalue\r\n";

        $serializer = new RequestSerializer();

        $command = $this->getMockBuilder(Command::class)->getMock();
        $command->expects($this->once())
            ->method('getCommand')
            ->willReturn('SET');

        $command->expects($this->once())
            ->method('getArguments')
            ->willReturn($arguments);

        $command->expects($this->any())
            ->method('__toString')
            ->willReturn($expected);

        $this->assertEquals($expected, $serializer->serialize($command));
    }

    public function test_serialize_invalid_type()
    {
        $serializer = new RequestSerializer();

        $this->expectException(\UnexpectedValueException::class);
        $serializer->serialize(new \stdClass());
    }
}