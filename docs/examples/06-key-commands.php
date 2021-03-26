<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('DEL');
$redis->set('key01', 'Hello');
$redis->set('key02', 'World');
var_dump($redis->del('key01', 'key02'));

echoInfo('DUMP');
$redis->set('key01', 'Hello');
echo $redis->dump('key01') . PHP_EOL;

echoInfo('EXISTS');
$redis->set('key01', 'Hello');
$redis->set('key02', 'World');
echo $redis->exists('key00') . PHP_EOL;
echo $redis->exists('key01', 'key02') . PHP_EOL;

echoInfo('EXPIRE');
$redis->set('key01', 'Hello');
$redis->expire('key01', 1);
echo $redis->exists('key01') . PHP_EOL;
sleep(1);
echo $redis->exists('key01') . PHP_EOL;

echoInfo('EXPIREAT');
$redis->set('key01', 'Hello');
$date = new DateTime();
$redis->expireAt('key01', $date->modify('+1 seconds')->getTimestamp());
echo $redis->exists('key01') . PHP_EOL;
sleep(1);
echo $redis->exists('key01') . PHP_EOL;

echoInfo('KEYS');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
var_dump($redis->keys('key*'));

/*echoInfo('MIGRATE');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
var_dump($redis->migrate('key*'));*/

echoInfo('MOVE');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
var_dump($redis->move('key01', 5));

echoInfo('OBJECT');
var_dump($redis->object('REFCOUNT', 'key01'));
var_dump($redis->object('ENCODING', 'key01'));
var_dump($redis->object('IDLETIME', 'key01'));
//var_dump($redis->object('FREQ', 'key01'));

echoInfo('PERSIST');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
var_dump($redis->persist('key01'));

echoInfo('PEXPIRE');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
var_dump($redis->pExpire('key01', 1000));
sleep(1);
echo $redis->exists('key01') . PHP_EOL;

echoInfo('PEXPIREAT');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
echo $redis->exists('key01') . PHP_EOL;
var_dump($redis->pExpireAt('key01', intval(microtime(true) * 1000)));
sleep(1);
echo $redis->exists('key01') . PHP_EOL;

echoInfo('PTTL');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
$redis->pExpire('key01', 2000);
var_dump($redis->pTtl('key01'));

echoInfo('RANDOMKEY');
var_dump($redis->randomKey());

echoInfo('RENAME');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
var_dump($redis->rename('key02', 'key05'));

echoInfo('RENAMENX');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
var_dump($redis->renameNx('key01', 'key02'));

echoInfo('RESTORE');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
$dump = $redis->dump('key01');
$redis->del('key01');
var_dump($redis->restore('key01', 0, $dump));

echoInfo('SCAN');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
var_dump($redis->scan(0, 'key*'));

echoInfo('SORT');
$redis->sAdd('list', range(1, 10));
var_dump($redis->sort('list'));

echoInfo('TOUCH');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
var_dump($redis->touch('key01', 'key02'));

echoInfo('TTL');
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
$redis->expire('key01', 2);
var_dump($redis->ttl('key01'));
