<?php

declare(strict_types=1);

namespace PhpRedis\Commands\Keys;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class Sort implements Command, Normalizable, ArgumentativeCommand
{
    use Stringify;
    use ToArray;
    use HasArguments;

    public const OPTION_DIRECTION = 'direction';
    public const OPTION_BY = 'by';
    public const OPTION_GET = 'get';
    public const OPTION_LIMIT = 'limit';
    public const OPTION_STORE = 'store';
    public const OPTION_SORT = 'sort';

    public const ASC = 'ASC';
    public const DESC = 'DESC';

    public const SORT_ALPHA = 'ALPHA';

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'SORT';
    }

    public function normalizeArguments(): array
    {
        [$key, $options] = array_pad($this->arguments, 2, null);
        if (! is_array($options)) {
            return $this->arguments;
        }

        $options = array_change_key_case($options, CASE_LOWER);

        $arguments = new \ArrayIterator();
        $arguments->append($key);

        foreach ([self::OPTION_DIRECTION, self::OPTION_SORT, self::OPTION_STORE] as $key) {
            if (! array_key_exists($key, $options)) {
                continue;
            }
            $arguments->append($options[$key]);
        }

        foreach ([self::OPTION_BY, self::OPTION_GET, self::OPTION_LIMIT] as $key) {
            if (! array_key_exists($key, $options)) {
                continue;
            }

            foreach ((array)$options[$key] as $option) {
                $arguments->append($key);
                $arguments->append($option);
            }
        }

        return $arguments->getArrayCopy();
    }
}
