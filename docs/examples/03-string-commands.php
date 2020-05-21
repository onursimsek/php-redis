<?php

require __DIR__ . '/01-simple-connection.php';

$phpRedis->set('key', 'value');
echoInfo('GET');
echo $phpRedis->get('key') . PHP_EOL;

echoInfo('INCR');
echo $phpRedis->incr('counter') . PHP_EOL;

echoInfo('INCR BY');
echo $phpRedis->incrBy('counterBy', 2) . PHP_EOL;

echoInfo('INCR BY FLOAT');
echo $phpRedis->incrByFloat('counterByFloat', .5) . PHP_EOL;

echoInfo('DECR');
echo $phpRedis->decr('decr') . PHP_EOL;

echoInfo('DECR BY');
echo $phpRedis->decrBy('decrBy', 2) . PHP_EOL;

echoInfo('GET RANGE');
echo $phpRedis->getRange('foo', 0, 10) . PHP_EOL;

echoInfo('SET RANGE');
echo $phpRedis->setRange('key', 8, 'range test') . PHP_EOL;

echoInfo('GET');
echo $phpRedis->get('key') . PHP_EOL;

echoInfo('STRLEN');
echo $phpRedis->strlen('key') . PHP_EOL;

echoInfo('MGET');
var_dump($phpRedis->mGet('paraf', 'counter'));

echoInfo('ERROR');
try {
    var_dump($phpRedis->foobar());
} catch (Exception $e) {
    var_dump($e->getMessage());
}

try {
    var_dump($phpRedis->incrBy('counterBy', 'asd'));
} catch (Exception $e) {
    var_dump($e->getMessage());
}

echoInfo('SET WITH EXPIRE');
$phpRedis->set('expire', 'value', 'EX', 1);
echo $phpRedis->get('expire') . PHP_EOL;
sleep(1);
echo $phpRedis->get('expire') . PHP_EOL;

echoInfo('MSET');
$phpRedis->mSet(['a' => 'b'], ['b' => 'c']);
var_dump($phpRedis->mGet('a', 'b'));

echoInfo('APPEND');
$phpRedis->set('append', 'app');
$phpRedis->append('append', 'end');
echo $phpRedis->get('append') . PHP_EOL;

echoInfo('BITCOUNT');
echo $phpRedis->bitCount('append') . PHP_EOL;

echoInfo('BITFIELD');
var_dump($phpRedis->bitField('mykey', 'INCRBY', 'i5', 100, 1, 'GET', 'u4', 0));

echoInfo('BITOP');
$phpRedis->mSet(['key1' => 'foobar'], ['key2' => 'abcdef']);
echo $phpRedis->bitOp('AND', 'dest', 'key1', 'key2') . PHP_EOL;
echo $phpRedis->get('dest') . PHP_EOL;

echoInfo('BITPOS');
$phpRedis->set('mykey', "\x00\xff\xf0");
echo $phpRedis->bitPos('mykey', 1, 2) . PHP_EOL;

echoInfo('SETBIT');
echo $phpRedis->setBit('mykey', 7, 1) . PHP_EOL;
echoInfo('GETBIT');
echo $phpRedis->getBit('mykey', 7) . PHP_EOL;

echoInfo('GETSET');
$phpRedis->set('mykey', 'HELLO');
echo $phpRedis->getSet('mykey', 'WORLD') . PHP_EOL;
echo $phpRedis->get('mykey') . PHP_EOL;

echoInfo('PSETEX');
$phpRedis->pSetEx('mykey', 1000, 'Hello');
sleep(1);
echo $phpRedis->get('mykey') . PHP_EOL;

echoInfo('SETEX');
$phpRedis->setEx('mykey', 1, 'Hello');
sleep(1);
echo $phpRedis->get('mykey') . PHP_EOL;

echoInfo('SETNX');
var_dump($phpRedis->setNx('setnx', 'Hello'));
echo $phpRedis->get('setnx') . PHP_EOL;
var_dump($phpRedis->setNx('setnx', 'World'));
echo $phpRedis->get('setnx') . PHP_EOL;
