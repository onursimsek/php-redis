<?php

namespace PhpRedis\Configurations;

class ConnectionParameter implements Parameter
{
    private array $hosts = [];
    private array $options = [];
    private string $connectionString;

    /**
     * ConnectionParameter constructor.
     * @param null $hosts
     * @param array $options
     */
    public function __construct($hosts = null, array $options = [])
    {
        if (! $hosts) {
            return;
        }

        if (is_string($hosts)) {
            $this->setConnectionString($hosts);
        } elseif (is_array($hosts)) {
            $this->hosts = $hosts;
        } else {
            throw new \InvalidArgumentException('Not supported host type');
        }

        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getHosts(): array
    {
        return $this->hosts;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
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
        $this->hosts = parse_url($connectionString);

        return $this;
    }
}
