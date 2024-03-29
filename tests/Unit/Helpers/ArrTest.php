<?php

namespace PhpRedis\Tests\Unit\Helpers;

use PhpRedis\Helpers\Arr;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ArrTest extends TestCase
{
    #[Test]
    public function can_be_flatten_an_array_with_keys()
    {
        $arguments = ['key', 'foo'];
        $expected = ['key', 'foo'];
        self::assertEquals($expected, Arr::flattenWithKeys($arguments));

        $arguments = ['key' => 1, 'foo' => 1];
        $expected = ['key', 1, 'foo', 1];
        self::assertEquals($expected, Arr::flattenWithKeys($arguments));

        $arguments = ['key', 'foo', ['bar' => 1]];
        $expected = ['key', 'foo', 'bar', 1];
        self::assertEquals($expected, Arr::flattenWithKeys($arguments));

        $arguments = ['key', 'foo', ['bar' => 1, 'aa' => 2]];
        $expected = ['key', 'foo', 'bar', 1, 'aa', 2];
        self::assertEquals($expected, Arr::flattenWithKeys($arguments));

        $arguments = ['key', 'foo', ['bar' => 1, 'aa' => [1, 2]]];
        $expected = ['key', 'foo', 'bar', 1, 'aa', 1, 2];
        self::assertEquals($expected, Arr::flattenWithKeys($arguments));

        $arguments = ['key', ['foo' => 1, ['foofoo' => 11, 'foobar' => 12], 'bar' => 2]];
        $expected = ['key', 'foo', 1, 'foofoo', 11, 'foobar', 12, 'bar', 2];
        self::assertEquals($expected, Arr::flattenWithKeys($arguments));
    }

    #[Test]
    public function can_be_get_only()
    {
        $arguments = ['foo' => 1, 'bar' => 2];
        $expected = ['foo' => 1];
        self::assertEquals($expected, Arr::only($arguments, ['foo']));
    }
}
