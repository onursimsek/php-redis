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

echoInfo('LPUSHX');
var_dump($redis->lPushX('non-existing-list', 'A', 'B'));

echoInfo('LRANGE');
var_dump($redis->lRange('list01', 0, -1));
var_dump($redis->lRange('non-existing-list', 0, -1));

echoInfo('LREM');
var_dump($redis->lRem('list01', 0, 'B'));

echoInfo('LSET');
var_dump($redis->lSet('list01', -1, 'B'));

echoInfo('LTRIM');
var_dump($redis->lTrim('list01', 1, -1));

echoInfo('RPOP');
var_dump($redis->rPop('list01'));

echoInfo('RPOPLPUSH');
var_dump($redis->rPoplPush('list01', 'other-list'));

echoInfo('RPUSH');
var_dump($redis->rPush('list01', 1, 2, 3, 4));

echoInfo('RPUSH');
var_dump($redis->rPushX('list02', 1, 2, 3, 4));
