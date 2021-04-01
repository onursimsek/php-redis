<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('BLPOP');
var_dump($redis->blPop('list01', 1));

echoInfo('BRPOP');
var_dump($redis->brPop('list01', 1));

echoInfo('BRPOPLPUSH');
var_dump($redis->brPoplPush('list01', 'list02', 1));

echoInfo('LINDEX');
var_dump($redis->lIndex('list01', 5));

echoInfo('LINSERT');
var_dump($redis->lInsert('list01', 'BEFORE', 'A', 'B'));

echoInfo('LLEN');
var_dump($redis->lLen('list01'));

echoInfo('LPOP');
var_dump($redis->lPop('list01'));

echoInfo('LPOS');
var_dump($redis->lPos('list01', 'A', ['COUNT' => 0, 'RANK' => 1]));

echoInfo('LPUSH');
var_dump($redis->lPush('list01', 'A', 'B'));
