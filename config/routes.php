<?php

use App\Routes\Router;

$router = new Router($container);
$router->get('/users', 'UserController@index');
$router->get('/users/{id}', 'UserController@show');

return $router;
