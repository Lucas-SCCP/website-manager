<?php

use App\Core\Container;

$container = new Container();
$container->set('UserController', \App\Controllers\UserController::class);

return $container;