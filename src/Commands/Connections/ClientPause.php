<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Connections;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

/**
 * Class ClientPause
 *
 * @link https://redis.io/commands/client-pause
 * @author Onur Şimşek <posta@onursimsek.com>
 */
class ClientPause implements Command, ArgumentativeCommand
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'CLIENT PAUSE';
    }
}
