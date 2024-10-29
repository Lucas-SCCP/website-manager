<?php

namespace App\Models;

class User {
    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;
    public $deleted_at;
    
    public function __construct(array $data = []) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
        $this->deleted_at = $data['deleted_at'] ?? '';
    }
}