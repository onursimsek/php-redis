<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('BZPOPMAX');
var_dump($redis->bzPopMax(['sorted-set01', 'sorted-set02'], 1));

echoInfo('BZPOPMIN');
var_dump($redis->bzPopMin(['sorted-set01', 'sorted-set02'], 1));

echoInfo('ZADD');
var_dump($redis->zAdd('sorted-set02', ['John' => 5, 'Doe' => 1]));

echoInfo('ZCARD');
var_dump($redis->zCard('sorted-set02'));

echoInfo('ZCOUNT');
var_dump($redis->zCount('sorted-set02', 1, 10));

echoInfo('ZINCRBY');
var_dump($redis->zIncrBy('sorted-set02', 2, 'John'));

echoInfo('ZINTERSTORE');
$redis->zAdd('sorted-set01', ['John' => 1]);
var_dump($redis->zInterStore('out', ['sorted-set01', 'sorted-set02']));

echoInfo('ZLEXCOUNT');
$redis->zAdd('lex-sort', ['a' => 1, 'b' => 1, 'c' => 1, 'd' => 1, 'e' => 1, 'f' => 1, 'g' => 1]);
var_dump($redis->zLexCount('lex-sort', '[b', '[f'));

echoInfo('ZPOPMAX');
$redis->zAdd('sorted-set03', ['a' => 10, 'b' => 9, 'c' => 8, 'd' => 7, 'e' => 6, 'f' => 5, 'g' => 4]);
var_dump($redis->zPopMax('sorted-set03', 2));

echoInfo('ZPOPMIN');
$redis->zAdd('sorted-set03', ['a' => 10, 'b' => 9, 'c' => 8, 'd' => 7, 'e' => 6, 'f' => 5, 'g' => 4]);
var_dump($redis->zPopMin('sorted-set03', 2));

echoInfo('ZRANGE');
var_dump($redis->zRange('sorted-set03', 0, -1));
