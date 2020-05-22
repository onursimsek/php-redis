<?php

require __DIR__ . '/01-simple-connection.php';

echo $phpRedis->getRedisVersion() . PHP_EOL;
echo $phpRedis->getLibraryRedisVersion() . PHP_EOL;

$phpRedis->set('key', 'value1');
echo 'GET => ' . $phpRedis->get('key') . PHP_EOL;

echo $phpRedis->raw('INFO', 'server') . PHP_EOL;