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
 * Class ClientKill
 *
 * @link https://redis.io/commands/client-kill
 * @author Onur Şimşek <posta@onursimsek.com>
 */
class ClientKill implements Command, ArgumentativeCommand, Normalizable
{
    use Stringify;
    use ToArray;
    use HasArguments;
    const TYPE_ADDR = 'ADDR';
    const TYPE_ID = 'ID';
    const TYPE_USER = 'USER';

    /**
     * {@inheritDoc}
     */
    public function getCommand(): string
    {
        return 'CLIENT KILL';
    }

    /**
     * {@inheritDoc}
     */
    public function normalizeArguments(): array
    {
        return array_map(function ($item) {
            return $item->toArray();
        }, $this->getArguments());
    }
}