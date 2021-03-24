<?php

declare(strict_types=1);

namespace PhpRedis;

use PhpRedis\Commands\Command;
use PhpRedis\Commands\CommandFactory;
use PhpRedis\Configurations\Parameter;
use PhpRedis\Connections\Connection;
use PhpRedis\Connections\StreamConnection;
use PhpRedis\Exceptions\UnsupportedCommandException;
use PhpRedis\Parameters\ClientKill;
use PhpRedis\Versions\CommandList;

/**
 * Class PhpRedis
 * @package PhpRedis
 *
 * String commands
 * @method int      append(string $key, string $value)
 * @method int      bitCount(string $key, int $start = null, int $end = null)
 * @method array    bitField(string $key, string $subCommand, ...$subCommandArguments)
 * @method int      bitOp(string $operation, string $destinationKey, string ...$sourceKeys)
 * @method int      bitPos(string $key, int $bit, int $start = null, int $end = null)
 * @method int      decr(string $key)
 * @method int      decrBy(string $key, int $increment)
 * @method string   get(string $key)
 * @method int      getBit(string $key, int $offset)
 * @method string   getRange(string $key, int $start, int $end)
 * @method string   getSet(string $key, string $value)
 * @method int      incr(string $key)
 * @method int      incrBy(string $key, int $increment)
 * @method float    incrByFloat(string $key, float $increment)
 * @method array    mGet(string ...$key)
 * @method bool     mSet(array ...$data)
 * @method int      mSetNx(array ...$data)
 * @method bool     pSetEx(string $key, int $milliseconds, string $value)
 * @method bool     set(string $key, string $value, string $expireType = null, int $expireTime = null, string $exist = null)
 * @method int      setBit(string $key, int $offset, int $value)
 * @method bool     setEx(string $key, int $seconds, string $value)
 * @method int      setNx(string $key, string $value)
 * @method string   setRange(string $key, int $start, string $value)
 * @method int      strlen(string $key)
 *
 * Connection commands
 * @method bool auth(string $password, string $username = null)
 * @method bool clientCaching(bool $status)
 * @method string|null clientGetName()
 * @method int clientGetRedir()
 * @method int clientId()
 * @method mixed clientKill(ClientKill $kill)           NOT COMPLETED
 * @method string clientList(string $type = null)
 * @method bool clientPause(int $milliseconds)
 * @method string|void clientReply(string $status)
 * @method bool clientSetName(string $name)
 * @method bool clientTracking()                        NOT IMPLEMENTED
 * @method int clientUnblock(int $clientId)             NOT TESTED
 * @method string echo(string $string)
 * @method string hello()                               NOT IMPLEMENTED
 * @method string ping(string $string = null)
 * @method bool quit()
 * @method bool select(int $index)
 */
class PhpRedis implements Client
{
    /**
     * @var Parameter
     */
    private $connectionParameter;

    /**
     * @var Connection
     */
    private $connection = null;

    public function __construct(Parameter $parameter)
    {
        $this->connectionParameter = $parameter;
    }

    public function isConnected(): bool
    {
        return $this->connection && $this->connection->isConnected();
    }

    public function connect(): bool
    {
        if (!$this->connection) {
            $this->connection = new StreamConnection();
        }

        if ($this->connection->isConnected()) {
            return true;
        }

        return $this->connection->connect($this->connectionParameter);
    }

    public function disconnect(): bool
    {
        return $this->connection->disconnect() && $this->connection = null;
    }

    public function getRedisVersion(): string
    {
        $this->connect();
        return $this->connection->getInfo('server')['redis_version'];
    }

    public function getLibraryRedisVersion(): string
    {
        [$major, $minor] = explode('.', $this->getRedisVersion());
        $version = $major . '.' . $minor;
        switch (true) {
            case self::REDIS_VERSION_320 >= $version:
            default:
                return self::REDIS_VERSION_320;
            case self::REDIS_VERSION_400 >= $version:
                return self::REDIS_VERSION_400;
            case self::REDIS_VERSION_500 >= $version:
                return self::REDIS_VERSION_500;
            case self::REDIS_VERSION_600 >= $version:
                return self::REDIS_VERSION_600;
        }
    }

    private function getCommandList()
    {
        return new CommandList($this->getLibraryRedisVersion());
    }

    public function raw(...$command)
    {
        return $this->connection->rawCommand($command);
    }

    private function executeCommand(Command $command)
    {
        return $this->connection->executeCommand($command);
    }

    public function __call(string $name, array $arguments)
    {
        $commandName = strtoupper($name);
        $commandList = $this->getCommandList()->toArray();

        if (!array_key_exists($commandName, $commandList)) {
            throw new UnsupportedCommandException("This command ('{$commandName}') is not supported");
        }

        return $this->executeCommand(
            CommandFactory::make($commandList[$commandName], $arguments, $commandName)
        );
    }
}
