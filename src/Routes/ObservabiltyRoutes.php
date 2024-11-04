<?php

namespace App\Routes;

class ObservabiltyRoutes
{
    public static function register(Router $router)
    {
        $router->get('/metrics', 'ObservabilityController@metrics');
    }
}
