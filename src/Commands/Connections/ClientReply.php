<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Connections;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

/**
 * Class ClientReply
 *
 * @link https://redis.io/commands/client-reply
 * @author Onur Şimşek <posta@onursimsek.com>
 */
class ClientReply implements Command, ArgumentativeCommand
{
    use Stringify;
    use ToArray;
    use HasArguments;

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'CLIENT REPLY';
    }
}