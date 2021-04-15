<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('GEOADD');
var_dump($redis->geoAdd('Sicily', ['Palermo' => [13.361389, 38.115556], 'Catania' => [15.087269, 37.502669]]));

echoInfo('GEODIST');
var_dump($redis->geoDist('Sicily', 'Palermo', 'Catania'));

echoInfo('GEOHASH');
var_dump($redis->geoHash('Sicily', 'Palermo', 'Catania'));
