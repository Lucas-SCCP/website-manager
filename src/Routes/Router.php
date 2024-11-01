<?php

namespace App\Routes;

use App\Controllers\UserController;

class Router
{
    private array $routes = [];

    public function get($path, $action)
    {
        $this->addRoute('GET', $path, $action);
    }

    public function post($path, $action)
    {
        $this->addRoute('POST', $path, $action);
    }

    private function addRoute($method, $path, $action)
    {
        $path = preg_replace('/\{(\w+)\}/', '(?P<\1>[^/]+)', $path);
        $this->routes[$method][$path] = $action;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $routeFound = false;
        foreach ($this->routes[$method] as $routePath => $action) {
            $pattern = "@^" . $routePath . "$@";
            if (preg_match($pattern, $path, $matches)) {
                $routeFound = true;
                [$controller, $method] = explode('@', $action);

                // Filtra parâmetros nomeados
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                if ($controller == 'UserController') {
                    $userController = new UserController();
                    $response = $userController->$method(...array_values($params));
                    echo json_encode($response);
                }
                break;
            }
        }

        if (!$routeFound) {
            http_response_code(404);
            echo json_encode('Route not found');
        }
    }
}