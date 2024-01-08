<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Connections;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

/**
 * Class ClientCaching
 *
 * @link https://redis.io/commands/client-caching
 * @author Onur Şimşek <posta@onursimsek.com>
 */
class ClientCaching implements Command, ArgumentativeCommand, Normalizable
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * {@inheritDoc}
     */
    public function getCommand(): string
    {
        return 'CLIENT CACHING';
    }

    /**
     * {@inheritDoc}
     */
    public function normalizeArguments(): array
    {
        $this->arguments[0] = $this->arguments[0] ? 'yes' : 'no';

        return $this->arguments;
    }
}
