<?php

require __DIR__ . '/../../vendor/autoload.php';

function echoInfo(string $string)
{
    echo '========================================' . PHP_EOL;
    echo '|' . str_pad($string, 38, ' ', STR_PAD_BOTH) . '|' . PHP_EOL;
    echo '========================================' . PHP_EOL;
}

$connectionString = 'tcp://localhost:6379';

$hosts = [
    'schema' => 'tcp',
    'host' => 'localhost',
    'port' => 6379,
];

$connectionParameter = new \PhpRedis\Configurations\ConnectionParameter($connectionString);

$phpRedis = new \PhpRedis\PhpRedis($connectionParameter);
$phpRedis->connect();

echo ($phpRedis->isConnected() ? 'connected' : 'not connected') . PHP_EOL;
