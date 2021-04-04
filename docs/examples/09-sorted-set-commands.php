<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('BZPOPMAX');
var_dump($redis->bzPopMax(['sorted-set01', 'sorted-set02'], 1));

echoInfo('BZPOPMIN');
var_dump($redis->bzPopMin(['sorted-set01', 'sorted-set02'], 1));

echoInfo('ZADD');
var_dump($redis->zAdd('sorted-set02', ['John' => 5, 'Doe' => 1]));

echoInfo('ZCARD');
var_dump($redis->zCard('sorted-set02'));

echoInfo('ZCOUNT');
var_dump($redis->zCount('sorted-set02', 1, 10));

echoInfo('ZINCRBY');
var_dump($redis->zIncrBy('sorted-set02', 2, 'John'));