<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class UserController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index()
    {
        // $user = $this->userRepository->find(1);
        return json_encode('teste');
    }

    public function show($id)
    {
        return $this->userRepository->find($id);
    }
}