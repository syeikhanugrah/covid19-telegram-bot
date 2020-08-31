<?php

require __DIR__.'/vendor/autoload.php';

$routes = require_once __DIR__.'/config/routes.php';

$bot = new \App\Kernel();
$bot->setRoutes($routes);
$bot->handle();
