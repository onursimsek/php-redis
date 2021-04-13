<?php

declare(strict_types=1);

namespace PhpRedis\Commands\SortedSets;

use PhpRedis\Commands\ArgumentativeCommand;
use PhpRedis\Commands\Command;
use PhpRedis\Commands\Normalizable;
use PhpRedis\Exceptions\ValidationException;
use PhpRedis\Helpers\Arr;
use PhpRedis\Traits\HasArguments;
use PhpRedis\Traits\Stringify;
use PhpRedis\Traits\ToArray;

class ZInterStore implements Command, ArgumentativeCommand, Normalizable
{
    use Stringify;
    use ToArray;
    use HasArguments;

    public const WEIGHTS = 'WEIGHTS';
    public const AGGREGATE = 'AGGREGATE';
    public const OPTIONS = [self::WEIGHTS, self::AGGREGATE];

    public const SUM = 'SUM';
    public const MIN = 'MIN';
    public const MAX = 'MAX';

    /**
     * @inheritDoc
     */
    public function getCommand(): string
    {
        return 'ZINTERSTORE';
    }

    public function normalizeArguments(): array
    {
        $this->arguments[1] = (array)$this->arguments[1];
        $arguments[] = $this->arguments[0];
        $arguments[] = count($this->arguments[1]);
        $arguments[] = $this->arguments[1];

        $arguments = [
            $this->arguments[0],
            count($this->arguments[1]),
            ...(array)$this->arguments[1],
        ];

        if (isset($this->arguments[2])) {
            $options = Arr::only(array_change_key_case((array)$this->arguments[2], CASE_UPPER), self::OPTIONS);
            if (array_key_exists(self::WEIGHTS, $options)) {
                if (count($options[self::WEIGHTS]) != $arguments[1]) {
                    throw new ValidationException();
                }

                $arguments = array_merge($arguments, Arr::flattenWithKeys([self::WEIGHTS => $options[self::WEIGHTS]]));
            }


            if (array_key_exists(self::AGGREGATE, $options)) {
                if (!in_array(strtoupper($options[self::AGGREGATE]), [self::SUM, self::MIN, self::MAX])) {
                    throw new ValidationException();
                }

                $arguments = array_merge(
                    $arguments,
                    Arr::flattenWithKeys([self::AGGREGATE => $options[self::AGGREGATE]])
                );
            }
        }

        return $arguments;
    }
}
