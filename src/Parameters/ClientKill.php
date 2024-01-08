<?php

declare(strict_types=1);

namespace PhpRedis\Parameters;

class ClientKill
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $type;

    /**
     * @var bool
     */
    private $skipMe;

    public function __construct(string $value, string $type = 'ADDR', bool $skipMe = true)
    {
        $this->value = $value;
        $this->type = $type;
        $this->skipMe = $skipMe;
    }

    public function toArray()
    {
        return [$this->type, $this->value, 'SKIPME', $this->skipMe ? 'yes' : 'no'];
    }
}
