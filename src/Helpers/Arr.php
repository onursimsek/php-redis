<?php

declare(strict_types=1);

namespace PhpRedis\Helpers;

class Arr
{
    public static function flattenWithKeys(array $array): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            $flatten = [];
            if (is_string($key)) {
                $flatten[] = $key;
            }

            if (is_array($value)) {
                $flatten = array_merge($flatten, static::flattenWithKeys($value));
            } else {
                $flatten[] = $value;
            }

            $result = array_merge($result, $flatten);
        }

        return $result;
    }

    public static function only(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }
}
