<?php

use PhpRedis\Commands\Geos\GeoRadius;

require __DIR__ . '/01-simple-connection.php';

echoInfo('GEOADD');
var_dump($redis->geoAdd('Sicily', ['Palermo' => [13.361389, 38.115556], 'Catania' => [15.087269, 37.502669]]));

echoInfo('GEODIST');
var_dump($redis->geoDist('Sicily', 'Palermo', 'Catania'));

echoInfo('GEOHASH');
var_dump($redis->geoHash('Sicily', 'Palermo', 'Catania'));

echoInfo('GEOPOS');
var_dump($redis->geoPos('Sicily', 'Palermo', 'Catania'));

echoInfo('GEORADIUS');
var_dump($redis->geoRadius('Sicily', 15, 37, 200, GeoRadius::UNIT_KILOMETERS, [GeoRadius::WITHCOORD, GeoRadius::WITHDIST, GeoRadius::WITHHASH]));
