<?php

namespace App\Routes;

use App\Core\Container;

class Router
{
    private array $routes = [];
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

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
        $method = $this->getHttpMethod();
        $path = $this->getEndpointPath();

        foreach ($this->routes[$method] as $routePath => $action) {
            $pattern = "@^" . $routePath . "$@";
            if (preg_match($pattern, $path, $matches)) {
                
                [$controllerName, $method] = explode('@', $action);
                $controller = $this->container->get($controllerName);
                
                if (method_exists($controller, $method)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    $response = $controller->$method(...array_values($params));
                    $this->sendSuccess($response);
                } else {
                    $this->sendError('Method not found', 404);
                }
                return;
            }
        }

        $this->sendError('Route not found', 404);
    }

    private function sendSuccess($data, $message = null, $statusCode = 200)
    {
        $response = [
            'success' => true,
            'data' => $data
        ];

        if (!is_null($message)) {
            $response['message'] = $message;
        }

        $this->sendResponse($response, $statusCode);
    }

    private function sendError($message, $statusCode = 404)
    {
        $response = [
            'success' => false,
            'error' => [
                'message' => $message
            ]
        ];
        $this->sendResponse($response, $statusCode);
    }

    private function sendResponse($response, $statusCode)
    {
        http_response_code($statusCode);
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    private function getHttpMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function getEndpointPath()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
