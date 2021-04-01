<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('BZPOPMAX');
var_dump($redis->bzPopMax(['sorted-set01', 'sorted-set02'], 1));

echoInfo('BZPOPMIN');
var_dump($redis->bzPopMin(['sorted-set01', 'sorted-set02'], 1));
