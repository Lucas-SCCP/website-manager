<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = require_once __DIR__ . '/../config/controllers.php';
$router = require_once __DIR__ . '/../config/routes.php';

$router->dispatch();
