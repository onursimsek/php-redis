<?php

require __DIR__ . '/01-simple-connection.php';

$command = new \PhpRedis\Commands\Strings\Set();
$command->setArguments(['key', 'value']);

var_dump($phpRedis->executeCommand($command));

$command = new \PhpRedis\Commands\Strings\Get();
$command->setArguments(['key']);

var_dump($phpRedis->executeCommand($command));
