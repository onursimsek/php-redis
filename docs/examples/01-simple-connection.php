<?php

require __DIR__ . '/../../vendor/autoload.php';

$connectionString = 'tcp://localhost:6379';

$hosts = [
    'schema' => 'tcp',
    'host' => 'localhost',
    'port' => 6379,
];

$connectionParameter = new \PhpRedis\Configurations\ConnectionParameter($connectionString);
//$connectionParameter->setConnectionString($connectionString);

$phpRedis = new \PhpRedis\PhpRedis();
$phpRedis->setConnectionParameter($connectionParameter)
    ->connect();

echo ($phpRedis->isConnected() ? 'connected' : 'not connected') . PHP_EOL;
