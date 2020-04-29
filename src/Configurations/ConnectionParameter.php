<?php

namespace PhpRedis\Configurations;

class ConnectionParameter implements Parameter
{
    /**
     * @var array
     */
    private $hosts = [];

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var string
     */
    private $connectionString;

    /**
     * ConnectionParameter constructor.
     * @param null $hosts
     * @param array $options
     */
    public function __construct($hosts = null, array $options = [])
    {
        if (!$hosts) {
            return;
        }

        switch (true) {
            case is_string($hosts):
                $this->setConnectionString($hosts);
                break;
            case is_array($hosts):
                $this->setHosts($hosts);
                break;
            default:
                throw new \InvalidArgumentException('Not supported host type');
        }

        $this->setOptions($options);
    }

    /**
     * @return array
     */
    public function getHosts(): array
    {
        return $this->hosts;
    }

    /**
     * @param array $hosts
     * @return $this
     */
    public function setHosts(array $hosts): self
    {
        $this->hosts = $hosts;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return string
     */
    public function getConnectionString(): string
    {
        return $this->connectionString;
    }

    /**
     * @param string $connectionString
     * @return $this
     */
    public function setConnectionString(string $connectionString): self
    {
        $this->connectionString = $connectionString;
        return $this->setHosts(parse_url($connectionString));
    }
}