<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Routes\Router;
use App\Core\Container;
use App\Services\PrometheusService;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new Container();
$prometheus = new PrometheusService();
$router = new Router($container, $prometheus);
$router->dispatch();
