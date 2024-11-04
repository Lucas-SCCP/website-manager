<?php

namespace App\Core;

use Exception;

class Container
{
    private array $instances = [];

    public function set ($name, ...$params)
    {
        $controllerClass = 'App\\Controllers\\' . $name;
        $this->instances[$name] = new $controllerClass(...$params);
    }

    public function get($name, ...$params)
    {
        if (!isset($this->instances[$name])) {
            throw new \Exception("Class $name not found in the container");
        }
        return new $this->instances[$name](...$params);
    }
}
