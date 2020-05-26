<?php

require __DIR__ . '/01-simple-connection.php';

echo $redis->getRedisVersion() . PHP_EOL;
echo $redis->getLibraryRedisVersion() . PHP_EOL;

$redis->set('key', 'value1');
echo 'GET => ' . $redis->get('key') . PHP_EOL;

echo $redis->raw('INFO', 'server') . PHP_EOL;