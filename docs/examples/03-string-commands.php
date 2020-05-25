<?php

require __DIR__ . '/01-simple-connection.php';

$redis->set('key', 'value');
echoInfo('GET');
echo $redis->get('key') . PHP_EOL;

echoInfo('INCR');
echo $redis->incr('counter') . PHP_EOL;

echoInfo('INCR BY');
echo $redis->incrBy('counterBy', 2) . PHP_EOL;

echoInfo('INCR BY FLOAT');
echo $redis->incrByFloat('counterByFloat', .5) . PHP_EOL;

echoInfo('DECR');
echo $redis->decr('decr') . PHP_EOL;

echoInfo('DECR BY');
echo $redis->decrBy('decrBy', 2) . PHP_EOL;

echoInfo('GET RANGE');
echo $redis->getRange('foo', 0, 10) . PHP_EOL;

echoInfo('SET RANGE');
echo $redis->setRange('key', 8, 'range test') . PHP_EOL;

echoInfo('GET');
echo $redis->get('key') . PHP_EOL;

echoInfo('STRLEN');
echo $redis->strlen('key') . PHP_EOL;

echoInfo('MGET');
var_dump($redis->mGet('paraf', 'counter'));

echoInfo('ERROR');
try {
    var_dump($redis->foobar());
} catch (Exception $e) {
    var_dump($e->getMessage());
}

try {
    var_dump($redis->incrBy('counterBy', 'asd'));
} catch (Exception $e) {
    var_dump($e->getMessage());
}

echoInfo('SET WITH EXPIRE');
$redis->set('expire', 'value', 'EX', 1);
echo $redis->get('expire') . PHP_EOL;
sleep(1);
echo $redis->get('expire') . PHP_EOL;

echoInfo('MSET');
$redis->mSet(['a' => 'b'], ['b' => 'c']);
var_dump($redis->mGet('a', 'b'));

echoInfo('APPEND');
$redis->set('append', 'app');
$redis->append('append', 'end');
echo $redis->get('append') . PHP_EOL;

echoInfo('BITCOUNT');
echo $redis->bitCount('append') . PHP_EOL;

echoInfo('BITFIELD');
var_dump($redis->bitField('mykey', 'INCRBY', 'i5', 100, 1, 'GET', 'u4', 0));

echoInfo('BITOP');
$redis->mSet(['key1' => 'foobar'], ['key2' => 'abcdef']);
echo $redis->bitOp('AND', 'dest', 'key1', 'key2') . PHP_EOL;
echo $redis->get('dest') . PHP_EOL;

echoInfo('BITPOS');
$redis->set('mykey', "\x00\xff\xf0");
echo $redis->bitPos('mykey', 1, 2) . PHP_EOL;

echoInfo('SETBIT');
echo $redis->setBit('mykey', 7, 1) . PHP_EOL;
echoInfo('GETBIT');
echo $redis->getBit('mykey', 7) . PHP_EOL;

echoInfo('GETSET');
$redis->set('mykey', 'HELLO');
echo $redis->getSet('mykey', 'WORLD') . PHP_EOL;
echo $redis->get('mykey') . PHP_EOL;

echoInfo('PSETEX');
$redis->pSetEx('mykey', 1000, 'Hello');
sleep(1);
echo $redis->get('mykey') . PHP_EOL;

echoInfo('SETEX');
$redis->setEx('mykey', 1, 'Hello');
sleep(1);
echo $redis->get('mykey') . PHP_EOL;

echoInfo('SETNX');
var_dump($redis->setNx('setnx', 'Hello'));
echo $redis->get('setnx') . PHP_EOL;
var_dump($redis->setNx('setnx', 'World'));
echo $redis->get('setnx') . PHP_EOL;
