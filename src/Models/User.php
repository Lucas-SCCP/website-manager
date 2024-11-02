<?php

namespace App\Models;

class User {
    public $id;
    public $name;
    public $email;
    public $password;
    public $createdAt;
    public $updatedAt;
    public $deletedAt;
    
    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->createdAt = $data['created_at'] ?? '';
        $this->updatedAt = $data['updated_at'] ?? '';
        $this->deletedAt = $data['deleted_at'] ?? '';
    }
}
