<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Strings;

use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;

class Get implements StringCommand
{
    use HasArguments;
    use Stringify;

    public function getCommand()
    {
        return 'GET';
    }
}