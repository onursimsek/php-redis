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
$redis->expire('key01', 2);
echo $redis->exists('key01') . PHP_EOL;
sleep(2);
echo $redis->exists('key01') . PHP_EOL;

echoInfo('EXPIREAT');
$redis->set('key01', 'Hello');
$date = new DateTime();
$redis->expireAt('key01', $date->modify('+2 seconds')->getTimestamp());
echo $redis->exists('key01') . PHP_EOL;
sleep(2);
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
$redis->mSet(['key01' => 'Hello', 'key02' => 'World']);
var_dump($redis->object('REFCOUNT', 'key01'));
var_dump($redis->object('ENCODING', 'key01'));
var_dump($redis->object('IDLETIME', 'key01'));
//var_dump($redis->object('FREQ', 'key01'));
