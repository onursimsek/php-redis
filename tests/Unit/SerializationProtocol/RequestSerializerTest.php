<?php

namespace PhpRedis\Tests\Unit\SerializationProtocol;

use PhpRedis\Commands\GenericCommand;
use PhpRedis\SerializationProtocol\RequestSerializer;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

class RequestSerializerTest extends TestCase
{
    protected RequestSerializer $serializer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->serializer = new RequestSerializer();
    }

    #[Test]
    public function serialize_string()
    {
        $argument = 'PING';
        $expected = "$4\r\nPING\r\n";

        self::assertEquals($expected, $this->serializer->serialize($argument));
    }

    #[Test]
    public function serialize_array()
    {
        $arguments = ['key', 'value'];
        $expected = "*2\r\n$3\r\nkey\r\n$5\r\nvalue\r\n";

        self::assertEquals($expected, $this->serializer->serialize($arguments));

        $arguments = [['key', 'value'], ['foo', 'bar']];
        $expected = "*4\r\n$3\r\nkey\r\n$5\r\nvalue\r\n$3\r\nfoo\r\n$3\r\nbar\r\n";

        self::assertEquals($expected, $this->serializer->serialize($arguments));

        $arguments = [['key' => 'value'], ['foo' => 'bar']];
        $expected = "*4\r\n$3\r\nkey\r\n$5\r\nvalue\r\n$3\r\nfoo\r\n$3\r\nbar\r\n";

        self::assertEquals($expected, $this->serializer->serialize($arguments));
    }

    #[Test]
    public function serialize_command()
    {
        $arguments = ['SET', 'key', 'value'];
        $expected = "*3\r\n$3\r\nSET\r\n$3\r\nkey\r\n$5\r\nvalue\r\n";

        $command = $this->getMockBuilder(GenericCommand::class)->getMock();
        $command->expects($this->once())
            ->method('toArray')
            ->willReturn($arguments);

        $command->expects($this->any())
            ->method('__toString')
            ->willReturn($expected);

        self::assertEquals($expected, $this->serializer->serialize($command));
    }

    #[Test]
    public function serialize_invalid_type()
    {
        $this->expectException(UnexpectedValueException::class);
        $this->serializer->serialize(new \stdClass());
    }
}
