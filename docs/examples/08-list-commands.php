<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('BLPOP');
var_dump($redis->blPop('list01', 2));
