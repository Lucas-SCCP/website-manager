<?php

require 'vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Olá, Slim!");
    return $response;
});

$app->run();