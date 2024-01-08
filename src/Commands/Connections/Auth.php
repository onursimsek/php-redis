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
 * Class Auth
 *
 * @link https://redis.io/commands/auth
 * @author Onur Şimşek <posta@onursimsek.com>
 */
class Auth implements Command, ArgumentativeCommand, Normalizable
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * {@inheritDoc}
     */
    public function getCommand(): string
    {
        return 'AUTH';
    }

    /**
     * The second parameter (username) is sent to Redis as the first parameter
     * AUTH <username> <password>
     *
     * {@inheritDoc}
     */
    public function normalizeArguments(): array
    {
        return count($this->arguments) === 2 ? array_reverse($this->arguments) : $this->arguments;
    }
}
