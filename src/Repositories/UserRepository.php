<?php

namespace App\Repositories;

use PDO;
use App\Models\User;

class UserRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function find($id) {
        $stmt = $this->db->prepare('SELECT * FROM user WHERE id = 1');
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new User($result) : null;
    }

    public function create()
    {
        // 
    }

    public function update()
    {
        //
    }

    public function delete()
    {
        //
    }
}