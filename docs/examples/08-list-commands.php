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
