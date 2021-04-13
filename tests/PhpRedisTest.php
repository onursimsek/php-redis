<?php

namespace PhpRedis\Tests;

use PhpRedis\Configurations\Parameter;
use PhpRedis\Exceptions\UnsupportedCommandException;
use PhpRedis\PhpRedis;
use PHPUnit\Framework\TestCase;

class PhpRedisTest extends TestCase
{
    /**
     * @var PhpRedis
     */
    protected $client;

    public function test_client_can_be_connected_with_correct_parameters()
    {
        self::assertTrue($this->client->connect());
    }

    public function test_client_can_be_disconnectable()
    {
        $this->client->connect();
        self::assertFalse($this->client->disconnect());
    }

    public function test_client_can_be_returned_connection_status()
    {
        self::assertFalse($this->client->isConnected());

        $this->client->connect();
        self::assertTrue($this->client->isConnected());
    }

    public function test_client_can_be_returned_redis_version()
    {
        $redisVersion = $this->client->getRedisVersion();
        self::assertIsString($redisVersion);

        $libraryRedisVersion = $this->client->getLibraryRedisVersion();
        self::assertIsString($libraryRedisVersion);
        self::assertStringStartsWith($libraryRedisVersion, $redisVersion);

        $client = $this->getMockBuilder(PhpRedis::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getRedisVersion'])
            ->getMock();

        $client->expects($this->once())
            ->method('getRedisVersion')
            ->willReturn('3.2.0');

        self::assertEquals(PhpRedis::REDIS_VERSION_320, $client->getLibraryRedisVersion());

        $client = $this->getMockBuilder(PhpRedis::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getRedisVersion'])
            ->getMock();

        $client->expects($this->once())
            ->method('getRedisVersion')
            ->willReturn('4.0.0');

        self::assertEquals(PhpRedis::REDIS_VERSION_400, $client->getLibraryRedisVersion());

        $client = $this->getMockBuilder(PhpRedis::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getRedisVersion'])
            ->getMock();

        $client->expects($this->once())
            ->method('getRedisVersion')
            ->willReturn('5.0.0');

        self::assertEquals(PhpRedis::REDIS_VERSION_500, $client->getLibraryRedisVersion());
    }

    public function test_client_can_be_run_raw_command()
    {
        $this->client->connect();

        $argument = 'Hello';
        $expect = 'Hello';
        self::assertTrue($this->client->raw('set', 'mykey', $argument));
        self::assertEquals($expect, $this->client->raw('get', 'mykey'));
    }

    public function test_client_should_be_run_defined_command()
    {
        $this->client->connect();

        $argument = 'Hello';
        $expect = 'Hello';
        self::assertTrue($this->client->set('mykey', $argument));
        self::assertEquals($expect, $this->client->get('mykey'));
    }

    public function test_client_should_be_run_defined_command_on_version_320()
    {
        $this->client->connect();

        $argument = 'World';
        $expect = 'HelloWorld';
        self::assertTrue($this->client->set('mykey', 'Hello'));
        self::assertIsInt($this->client->append('mykey', $argument));
        self::assertEquals($expect, $this->client->get('mykey'));
    }

    public function test_client_should_be_run_defined_command_on_version_600()
    {
        $this->client->connect();

        $argument = 'Hello';
        $expect = 'Hello';
        self::assertTrue($this->client->set('mykey', $argument));
        self::assertEquals($expect, $this->client->get('mykey'));
    }

    public function test_client_should_not_be_run_undefined_command()
    {
        $this->client->connect();

        self::expectException(UnsupportedCommandException::class);
        $this->client->foo('key', 'value');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new PhpRedis($this->getParameter());
    }

    private function getParameter(): Parameter
    {
        /** @var Parameter $parameter */
        $parameter = $this->getMockBuilder(Parameter::class)->getMock();
        $parameter->expects($this->any())
            ->method('getConnectionString')
            ->willReturn('tcp://localhost:6379');

        return $parameter;
    }
}
