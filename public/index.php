<?php

use app\library\Cache;

require '../vendor/autoload.php';

$cache = new Cache('cache');
$data = $cache->create(['name' => 'Alexandre', 'address' => 'my address', 'age' => 40]);
var_dump($data);
