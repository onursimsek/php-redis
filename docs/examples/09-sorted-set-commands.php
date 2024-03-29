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

echoInfo('ZRANGEBYLEX');
var_dump($redis->zRangeByLex('lex-sort', '-', '[c'));
var_dump($redis->zRangeByLex('lex-sort', '-', '+', ['LIMIT' => [0, 2]]));

echoInfo('ZRANGEBYSCORE');
var_dump($redis->zRangeByScore('sorted-set03', '-inf', '+inf', ['WITHSCORES', 'LIMIT' => [0, 2]]));

echoInfo('ZRANK');
var_dump($redis->zRank('sorted-set03', 'd'));

echoInfo('ZREM');
var_dump($redis->zRem('sorted-set03', 'd', 'b'));

echoInfo('ZREMRANGEBYLEX');
$redis->zAdd('sorted-set04', ['aaaa' => 0, 'b' => 0, 'c' => 0, 'd' => 0, 'e' => 0, 'foo' => 0, 'zap' => 0, 'zip' => 0, 'ALPHA' => 0, 'alpha' => 0]);
var_dump($redis->zRemRangeByLex('sorted-set04', '[alpha', '[omega'));

echoInfo('ZREMRANGEBYRANK');
$redis->zAdd('sorted-set04', ['aaaa' => 0, 'b' => 0, 'c' => 0, 'd' => 0, 'e' => 0, 'foo' => 0, 'zap' => 0, 'zip' => 0, 'ALPHA' => 0, 'alpha' => 0]);
var_dump($redis->zRemRangeByRank('sorted-set04', 0, 3));

echoInfo('ZREMRANGEBYSCORE');
$redis->zAdd('sorted-set04', ['aaaa' => 0, 'b' => 0, 'c' => 0, 'd' => 0, 'e' => 0, 'foo' => 0, 'zap' => 0, 'zip' => 0, 'ALPHA' => 0, 'alpha' => 0]);
var_dump($redis->zRemRangeByScore('sorted-set04', '-inf', '(2'));

$redis->zAdd('sorted-set04', ['aaaa' => 0, 'b' => 0, 'c' => 0, 'd' => 0, 'e' => 0, 'foo' => 0, 'zap' => 0, 'zip' => 0, 'ALPHA' => 0, 'alpha' => 0]);
echoInfo('ZREVRANGE');
var_dump($redis->zRevRange('sorted-set04', 0, -1));

echoInfo('ZREVRANGEBYLEX');
var_dump($redis->zRevRangeByLex('sorted-set04', '+', '-'));

echoInfo('ZREVRANGEBYSCORE');
var_dump($redis->zRevRangeByScore('sorted-set04', 0, 0, ['WITHSCORES', 'LIMIT' => [0, 2]]));

echoInfo('ZREVRANK');
var_dump($redis->zRevRank('sorted-set04', 'foo'));

echoInfo('ZSCAN');
var_dump($redis->zScan('sorted-set04', 0, 'a*'));

echoInfo('ZSCORE');
var_dump($redis->zScore('sorted-set04', 'alpha'));

echoInfo('ZUNIONSCORE');
var_dump($redis->zUnionStore('sorted-set-out', 2, ['sorted-set03', 'sorted-set04']));
