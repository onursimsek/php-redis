<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('HDEL');
var_dump($redis->hDel('hashkey01', 'field01', 'field02'));

echoInfo('HEXIST');
var_dump($redis->hExists('hashkey01', 'field01'));

echoInfo('HGET');
var_dump($redis->hGet('hashkey01', 'field01'));

echoInfo('HGETALL');
var_dump($redis->hGetAll('hashkey01'));

echoInfo('HINCRBY');
var_dump($redis->hIncrBy('hashkey01', 'field01', 1));

echoInfo('HINCRBYFLOAT');
var_dump($redis->hIncrByFloat('hashkey01', 'field01', 1.5));

echoInfo('HKEYS');
var_dump($redis->hKeys('hashkey01'));

echoInfo('HLEN');
var_dump($redis->hLen('hashkey01'));

echoInfo('HMGET');
var_dump($redis->hMGet('hashkey01', 'field01', 'field02'));

//echoInfo('HMSET');
//var_dump($redis->hMSet('hashkey01', ['field01' => 'value01', 'field02' => 'value02']));

echoInfo('HSCAN');
var_dump($redis->hScan('hashkey01', 0));

