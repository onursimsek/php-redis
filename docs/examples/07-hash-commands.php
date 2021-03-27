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
