<?php

$routes = [
    '/' => [
        'method' => 'GET',
        'controller' => 'HomeController',
        'methodName' => 'index',
    ],
    '/users' => [
        'method' => 'GET',
        'controller' => 'UserController',
        'methodName' => 'index',
    ],
    // Adicione mais rotas conforme necessário
];