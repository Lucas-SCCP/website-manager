<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Routes\Router;

$router = new Router();
$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');
$router->dispatch();