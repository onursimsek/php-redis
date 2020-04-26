<?php

namespace PhpRedis\Tests\Connections;

use PhpRedis\Configurations\ConnectionParameter;
use PhpRedis\Connections\StreamConnection;
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

    private function getConnectionParameter()
    {
        return new ConnectionParameter('tcp://127.0.0.1:6379');
    }
}
