<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class UserController
{
    private $userRepository;

    public function __construct($db)
    {
        $this->userRepository = new UserRepository($db);
    }

    public function index()
    {
        $user = $this->userRepository->find(1);
        return json_encode(['message' => $user]);
    }
}