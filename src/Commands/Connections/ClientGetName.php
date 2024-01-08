<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Connections;

use PhpRedis\Commands\Command;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

/**
 * Class ClientGetName
 *
 * @link https://redis.io/commands/client-getname
 * @author Onur Şimşek <posta@onursimsek.com>
 */
class ClientGetName implements Command
{
    use Stringify;
    use ToArray;

    /**
     * {@inheritDoc}
     */
    public function getCommand(): string
    {
        return 'CLIENT GETNAME';
    }
}
