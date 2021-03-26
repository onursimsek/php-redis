<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('DEL');
$redis->set('key01', 'Hello');
$redis->set('key02', 'World');
var_dump($redis->del('key01', 'key02'));

echoInfo('DUMP');
$redis->set('key01', 'Hello');
echo $redis->dump('key01') . PHP_EOL;
