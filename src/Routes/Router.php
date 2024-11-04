<?php

namespace App\Routes;

use App\Core\Container;
use App\Responses\SuccessResponse;
use App\Responses\ErrorResponse;
use App\Services\PrometheusService;

class Router
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';

    private array $routes = [];
    private Container $container;
    private PrometheusService $prometheus;
    private $prometheusRegistry;

    public function __construct(Container $container, PrometheusService $prometheus)
    {
        $this->container = $container;
        $this->prometheus = $prometheus;
        $this->prometheusRegistry = $prometheus->getRegistry();
        
        $this->loadRoutes();
    }

    private function loadRoutes()
    {
        \App\Routes\UserRoutes::register($this);
        \App\Routes\ObservabiltyRoutes::register($this);
    }

    public function get($path, $action)
    {
        $this->addRoute(self::METHOD_GET, $path, $action);
    }

    public function post($path, $action)
    {
        $this->addRoute(self::METHOD_POST, $path, $action);
    }

    private function addRoute($method, $path, $action)
    {
        $path = preg_replace('/\{(\w+)\}/', '(?P<\1>[^/]+)', $path);
        $this->routes[$method][$path] = $action;

        [$controllerName, $method] = explode('@', $action);
        $this->container->set($controllerName, $this->prometheusRegistry);
    }

    public function dispatch()
    {
        $this->prometheus->registerCounterRequest();
        $method = $this->getHttpMethod();
        $path = $this->getEndpointPath();

        foreach ($this->routes[$method] as $routePath => $action) {
            if ($this->matchRoute($routePath, $path, $action)) {
                return;
            }
        }
        $path = 'route-not-found';
        $this->prometheus->registerCounterHTTPStatus(404, $path);
        $response = new ErrorResponse('Error', 404);
        echo $response->jsonFormat();
    }

    private function matchRoute($routePath, $path, $action)
    {
        $statusCode = 404;
        $pattern = "@^" . $routePath . "$@";
        if (preg_match($pattern, $path, $matches)) {
            
            [$controllerName, $method] = explode('@', $action);
            $controller = $this->container->get($controllerName, $this->prometheusRegistry);
            
            if (method_exists($controller, $method)) {
                $statusCode = 200;
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $data = $controller->$method(...array_values($params));
                $response = new SuccessResponse($data, '', $statusCode);
                echo $response->jsonFormat();
                return true;
            } else {
                $path = 'method-not-found';
                $response = new ErrorResponse('Error', $statusCode);
                echo $response->jsonFormat();
                return true;
            }
            $this->prometheus->registerCounterHTTPStatus($statusCode, $path);
            return false;
        }
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
