<?php

namespace PhpRedis\Tests\Configurations;

use PhpRedis\Configurations\ConnectionParameter;
use PHPUnit\Framework\TestCase;

class ConnectionParameterTest extends TestCase
{
    protected $connectionString = 'tcp://localhost:6379';

    protected $hosts = [
        'scheme' => 'tcp',
        'host' => 'localhost',
        'port' => 6379,
    ];

    protected $options = [
        'timeout' => 10,
        'persistent' => true,
    ];

    public function test_connection_with_string()
    {
        $connectionParameter = new ConnectionParameter();
        $connectionParameter->setConnectionString($this->connectionString);

        $this->assertEquals($this->connectionString, $connectionParameter->getConnectionString());
        $this->assertEquals(parse_url($this->connectionString), $connectionParameter->getHosts());

        $connectionParameter = new ConnectionParameter($this->connectionString);

        $this->assertEquals($this->connectionString, $connectionParameter->getConnectionString());
        $this->assertEquals(parse_url($this->connectionString), $connectionParameter->getHosts());
    }

    public function test_connection_with_array()
    {
        $connectionParameter = new ConnectionParameter($this->hosts);
        $this->assertEquals($this->hosts, $connectionParameter->getHosts());
    }

    public function test_connection_options()
    {
        $connectionParameter = new ConnectionParameter($this->hosts, $this->options);
        $this->assertEquals($this->options, $connectionParameter->getOptions());
    }

    public function test_host_should_not_be_null_on_construct()
    {
        $connectionParameter = new ConnectionParameter($this->connectionString, $this->options);

        $this->assertEquals($this->connectionString, $connectionParameter->getConnectionString());
        $this->assertEquals(parse_url($this->connectionString), $connectionParameter->getHosts());
        $this->assertEquals($this->options, $connectionParameter->getOptions());

        $connectionParameter = new ConnectionParameter(null, $this->options);

        $this->assertEquals([], $connectionParameter->getHosts());
        $this->assertEquals([], $connectionParameter->getOptions());
        $this->expectException(\TypeError::class);
        $connectionParameter->getConnectionString();
    }

    public function test_host_should_be_set_string_or_array_on_construct()
    {
        $this->expectException(\InvalidArgumentException::class);
        new ConnectionParameter(123);
    }
}
