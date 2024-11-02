<?php

namespace App\Core;

class Container
{
    private array $instances = [];

    public function set ($name, $class)
    {
        $this->instances[$name] = $class;
    }

    public function get($name)
    {
        if (!isset($this->instances[$name])) {
            throw new \Exception("Class $name not found in the container");
        }
        return new $this->instances[$name];
    }
}