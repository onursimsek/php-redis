<?php

require __DIR__ . '/01-simple-connection.php';

echoInfo('GEO ADD');
var_dump($redis->geoAdd('Sicily', ['Palermo' => [13.361389, 38.115556], 'Catania' => [15.087269, 37.502669]]));
