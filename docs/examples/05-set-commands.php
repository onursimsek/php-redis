<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('SADD');
echo $redis->sAdd('foo', 'member01', 'member02', 'member03') . PHP_EOL;

echoInfo('SCARD');
echo $redis->sCard('foo') . PHP_EOL;

echoInfo('SDIFF');
$redis->sAdd('key1', 'A', 'B', 'C');
$redis->sAdd('key2', 'A', 'C', 'F');
var_dump($redis->sDiff('key1', 'key2'));

echoInfo('SDIFFSTORE');
echo $redis->sDiffStore('diff', 'key1', 'key2') . PHP_EOL;

echoInfo('SINTER');
var_dump($redis->sInter('key1', 'key2'));

echoInfo('SINTERSTORE');
echo $redis->sDiffStore('inter', 'key1', 'key2') . PHP_EOL;

echoInfo('SISMEMBER');
echo $redis->sIsMember('foo', 'member01') . PHP_EOL;
echo $redis->sIsMember('foo', 'member99') . PHP_EOL;

echoInfo('SMEMBERS');
var_dump($redis->sMembers('foo'));

echoInfo('SMOVE');
echo ($redis->sMove('key1', 'key2', 'A') ? 'moved' : 'not moved') . PHP_EOL;

echoInfo('SPOP');
echo $redis->sPop('foo') . PHP_EOL;

echoInfo('SRANDMEMBER');
var_dump($redis->sRandMember('foo', 2));

echoInfo('SREM');
echo $redis->sRem('foo', 'member03') . PHP_EOL;

echoInfo('SUNION');
var_dump($redis->sUnion('key1', 'key2'));

echoInfo('SUNIONSTORE');
var_dump($redis->sUnionStore('union', 'key1', 'key2'));