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
 * Class ClientList
 *
 * @link https://redis.io/commands/client-list
 * @author Onur Şimşek <posta@onursimsek.com>
 */
class ClientList implements Command, ArgumentativeCommand, Normalizable
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * {@inheritDoc}
     */
    public function getCommand(): string
    {
        return 'CLIENT LIST';
    }

    /**
     * Input => Command: Client List
     *          Arguments[0]: normal
     *
     * Output => Client List Type normal
     *
     * {@inheritDoc}
     */
    public function normalizeArguments(): array
    {
        if ($arguments = $this->arguments) {
            array_unshift($arguments, 'TYPE');
        }

        return $arguments;
    }
}