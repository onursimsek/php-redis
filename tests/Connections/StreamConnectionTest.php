<?php

namespace PhpRedis\Tests\Connections;

use PhpRedis\Commands\Command;
use PhpRedis\Configurations\ConnectionParameter;
use PhpRedis\Connections\StreamConnection;
use PhpRedis\Exceptions\ConnectionException;
use PHPUnit\Framework\TestCase;

class StreamConnectionTest extends TestCase
{
    /**
     * @var StreamConnection
     */
    protected $connection;

    /**
     * @var ConnectionParameter
     */
    protected $connectionParameter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->connection = new StreamConnection();
        $this->connectionParameter = new ConnectionParameter('tcp://127.0.0.1:6379');
    }

    public function test_connect()
    {
        $this->assertTrue($this->connection->connect($this->connectionParameter));
    }

    public function test_is_connected()
    {
        $this->connection->connect($this->connectionParameter);

        self::assertTrue($this->connection->isConnected());
    }

    public function test_disconnect()
    {
        $this->connection->connect($this->connectionParameter);

        self::assertTrue($this->connection->isConnected());

        $this->connection->disconnect();

        self::assertFalse($this->connection->isConnected());
    }

    public function test_execute_command()
    {
        $this->connection->connect($this->connectionParameter);

        $command = $this->getMockBuilder(Command::class)->getMock();

        $command->expects($this->once())
            ->method('__toString')
            ->willReturn("*3\r\n$3\r\nSET\r\n$3\r\nkey\r\n$5\r\nvalue\r\n");

        self::assertTrue($this->connection->executeCommand($command));
    }

    public function test_unable_to_connect()
    {
        self::expectException(ConnectionException::class);

        $this->connection->connect(new ConnectionParameter('tcp://localhost:637'));
    }
}