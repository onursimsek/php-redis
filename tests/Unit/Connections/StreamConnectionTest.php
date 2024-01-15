<?php

namespace PhpRedis\Tests\Connections;

use PhpRedis\Commands\Command;
use PhpRedis\Configurations\ConnectionParameter;
use PhpRedis\Connections\StreamConnection;
use PhpRedis\Exceptions\PhpRedisException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(StreamConnection::class)]
class StreamConnectionTest extends TestCase
{
    protected StreamConnection $connection;

    protected ConnectionParameter $connectionParameter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->connection = new StreamConnection();
        $this->connectionParameter = new ConnectionParameter('tcp://127.0.0.1:6379');
    }

    #[Test]
    public function connect()
    {
        $this->assertTrue($this->connection->connect($this->connectionParameter));
    }

    #[Test]
    public function is_connected()
    {
        $this->connection->connect($this->connectionParameter);

        self::assertTrue($this->connection->isConnected());
    }

    #[Test]
    public function disconnect()
    {
        $this->connection->connect($this->connectionParameter);

        self::assertTrue($this->connection->isConnected());

        $this->connection->disconnect();

        self::assertFalse($this->connection->isConnected());
    }

    #[Test]
    public function execute_command()
    {
        $this->connection->connect($this->connectionParameter);

        $command = $this->getMockBuilder(Command::class)->getMock();

        $command->expects($this->once())
            ->method('__toString')
            ->willReturn("*3\r\n$3\r\nSET\r\n$3\r\nkey\r\n$5\r\nvalue\r\n");

        self::assertTrue($this->connection->executeCommand($command));
    }

    #[Test]
    public function raw_command()
    {
        $this->connection->connect($this->connectionParameter);

        self::assertTrue($this->connection->rawCommand(['SET', 'key', 'value']));
    }

    #[Test]
    public function redis_info()
    {
        $this->connection->connect($this->connectionParameter);

        self::assertArrayHasKey('server', $this->connection->getInfo());
        self::assertIsArray($this->connection->getInfo());

        $parseInfoResponseReflection = new \ReflectionMethod(StreamConnection::class, 'parseInfoResponse');

        self::assertEquals(
            ['server' => ['redis_version' => 'a.b.c']],
            $parseInfoResponseReflection->invoke($this->connection, "# Server\r\nredis_version:a.b.c\r\n")
        );

        self::expectException(PhpRedisException::class);
        $parseInfoResponseReflection->invoke($this->connection, "Server\r\nredis_version:7.2.4\r\n");
    }
}
