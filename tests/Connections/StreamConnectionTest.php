<?php

namespace PhpRedis\Tests\Connections;

use PhpRedis\Commands\Command;
use PhpRedis\Configurations\ConnectionParameter;
use PhpRedis\Connections\StreamConnection;
use PhpRedis\Exceptions\ConnectionException;
use PHPUnit\Framework\TestCase;

class StreamConnectionTest extends TestCase
{
    public function test_connect()
    {
        $connection = new StreamConnection();

        $this->assertTrue($connection->connect($this->getConnectionParameter()));
    }

    public function test_is_connected()
    {
        $connection = new StreamConnection();
        $connection->connect($this->getConnectionParameter());

        $this->assertTrue($connection->isConnected());
    }

    public function test_disconnect()
    {
        $connection = new StreamConnection();
        $connection->connect($this->getConnectionParameter());

        $this->assertTrue($connection->isConnected());

        $connection->disconnect();

        $this->assertFalse($connection->isConnected());
    }

    public function test_execute_command()
    {
        $connection = new StreamConnection();
        $connection->connect($this->getConnectionParameter());

        $command = $this->getMockBuilder(Command::class)->getMock();

        $command->expects($this->once())
            ->method('__toString')
            ->willReturn("*3\r\n$3\r\nSET\r\n$3\r\nkey\r\n$5\r\nvalue\r\n");

        $this->assertTrue($connection->executeCommand($command));
    }

    public function test_unable_to_connect()
    {
        $connection = new StreamConnection();

        $this->expectException(ConnectionException::class);

        $connection->connect(new ConnectionParameter('tcp://localhost:637'));
    }

    private function getConnectionParameter()
    {
        return new ConnectionParameter('tcp://127.0.0.1:6379');
    }
}