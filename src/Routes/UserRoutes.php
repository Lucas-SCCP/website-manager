<?php

namespace App\Routes;

class UserRoutes
{
    public static function register(Router $router)
    {
        $router->get('/users', 'UserController@index');
        $router->get('/users/{id}', 'UserController@show');
    }
}
