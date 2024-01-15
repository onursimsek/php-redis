<?php

namespace PhpRedis\Tests\Configurations;

use Error;
use InvalidArgumentException;
use PhpRedis\Configurations\ConnectionParameter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(ConnectionParameter::class)]
class ConnectionParameterTest extends TestCase
{
    protected string $connectionString = 'tcp://localhost:6379';

    protected array $hosts = [
        'scheme' => 'tcp',
        'host' => 'localhost',
        'port' => 6379,
    ];

    protected array $options = [
        'timeout' => 10,
        'persistent' => true,
    ];

    #[Test]
    public function connection_with_string()
    {
        $connectionParameter = new ConnectionParameter();
        $connectionParameter->setConnectionString($this->connectionString);

        $this->assertEquals($this->connectionString, $connectionParameter->getConnectionString());
        $this->assertEquals(parse_url($this->connectionString), $connectionParameter->getHosts());

        $connectionParameter = new ConnectionParameter($this->connectionString);

        $this->assertEquals($this->connectionString, $connectionParameter->getConnectionString());
        $this->assertEquals(parse_url($this->connectionString), $connectionParameter->getHosts());
    }

    #[Test]
    public function connection_with_array()
    {
        $connectionParameter = new ConnectionParameter($this->hosts);
        $this->assertEquals($this->hosts, $connectionParameter->getHosts());
    }

    #[Test]
    public function connection_options()
    {
        $connectionParameter = new ConnectionParameter($this->connectionString, $this->options);
        $this->assertEquals($this->options, $connectionParameter->getOptions());

        $connectionParameter = new ConnectionParameter($this->hosts, $this->options);
        $this->assertEquals($this->options, $connectionParameter->getOptions());
    }

    #[Test]
    public function host_should_not_be_null_on_construct()
    {
        $connectionParameter = new ConnectionParameter(null, $this->options);

        $this->assertEquals([], $connectionParameter->getHosts());
        $this->assertEquals([], $connectionParameter->getOptions());
        $this->expectException(Error::class);
        $connectionParameter->getConnectionString();
    }

    #[Test]
    public function host_should_be_set_string_or_array_on_construct()
    {
        $this->expectException(InvalidArgumentException::class);
        new ConnectionParameter(123);
    }
}
