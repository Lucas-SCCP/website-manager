<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$config = require __DIR__ . '/../config.php';
$routes = require __DIR__ . '/../routes.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = str_replace('/public', '', strtok($_SERVER['REQUEST_URI'], '?'));

$matchedRoute = $routes[$method][$path] ?? null;

if (!$matchedRoute) {
    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
    exit;
}

$db = getDatabaseConnection();

[$controller, $method] = explode('@', $matchedRoute);
$controllerClass = "App\\Controllers\\$controller";
$controllerInstance = new $controllerClass($db);

echo $controllerInstance->$method();
