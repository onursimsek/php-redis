<?php

declare(strict_types=1);

namespace PhpRedis\Commands;

use PhpRedis\Traits\AnonymousCommand as AnonymousCommandTrait;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class GenericCommand implements Command, AnonymousCommand, ArgumentativeCommand
{
    use AnonymousCommandTrait;
    use Stringify;
    use ToArray;
    use HasArguments;
}