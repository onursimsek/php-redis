<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Connections;

use PhpRedis\Commands\Command;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

/**
 * Class ClientId
 *
 * @link https://redis.io/commands/client-id
 * @author Onur Şimşek <posta@onursimsek.com>
 */
class ClientId implements Command
{
    use Stringify;
    use ToArray;

    /**
     * {@inheritDoc}
     */
    public function getCommand(): string
    {
        return 'CLIENT ID';
    }
}