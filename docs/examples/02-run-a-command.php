<?php

require __DIR__ . '/01-simple-connection.php';

$phpRedis->set('key', 'value1');
echo 'GET => ' . $phpRedis->get('key') . PHP_EOL;
