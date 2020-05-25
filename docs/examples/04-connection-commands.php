<?php

require __DIR__ . '/01-simple-connection.php';


echoInfo('AUTH');
//$redis->auth();

// version 6.0
echoInfo('CLIENT CACHING');
//var_dump($redis->clientCaching(true));

echoInfo('CLIENT GETNAME');
echo $redis->clientGetName() . PHP_EOL;

// version 6.0
echoInfo('CLIENT GETREDIR');
//echo $redis->clientGetRedir() . PHP_EOL;

echoInfo('CLIENT ID');
echo $redis->clientId() . PHP_EOL;

echoInfo('CLIENT KILL');
$kills = [
    new \PhpRedis\Parameters\ClientKill(266, 'ID', false),
    new \PhpRedis\Parameters\ClientKill(301, 'ID', false),
];
var_dump($redis->clientKill(...$kills));

echoInfo('CLIENT LIST');
echo $redis->clientList() . PHP_EOL;

echoInfo('CLIENT PAUSE');
var_dump($redis->clientPause(1000));

echoInfo('CLIENT REPLY');
var_dump($redis->clientReply('on'));

echoInfo('CLIENT SETNAME');
var_dump($redis->clientSetName('test'));
echo $redis->clientGetName() . PHP_EOL;

echoInfo('ECHO');
echo $redis->echo('Hello') . PHP_EOL;

// version 6.0
//echoInfo('HELLO');
//echo $redis->hello(1);

echoInfo('PING');
echo $redis->ping() . PHP_EOL;

echoInfo('SELECT');
var_dump($redis->select(1));

echoInfo('QUIT');
var_dump($redis->quit());
