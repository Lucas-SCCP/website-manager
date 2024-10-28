<?php

require 'vendor/autoload.php';

use Slim\Factory\AppFactory;

// Cria uma instância do aplicativo Slim
$app = AppFactory::create();

// Define uma rota simples
$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Olá, Slim!");
    return $response;
});

// Executa o aplicativo
$app->run();
