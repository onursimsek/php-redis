<?php

require __DIR__ . '/01-simple-connection.php';

$phpRedis->set('key', 'value1');
echo 'GET => ' . $phpRedis->get('key') . PHP_EOL;

echo 'INCR => ' . $phpRedis->incr('counter') . PHP_EOL;

echo 'INCRBY => ' . $phpRedis->incrby('counterBy', 2) . PHP_EOL;

echo 'INCRBYFLOAT => ' . $phpRedis->incrbyfloat('counterByFloat', .5) . PHP_EOL;

echo 'DECR => ' . $phpRedis->decr('decr') . PHP_EOL;

echo 'DECRBY => ' . $phpRedis->decrby('decrBy', 2) . PHP_EOL;