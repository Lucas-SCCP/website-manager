<?php

return [
    'GET' => [
        '/users' => 'UserController@index',
        '/users/{id}' => 'UserController@show',
    ],
    'POST' => [
        '/users' => 'UserController@store',
    ]
];
