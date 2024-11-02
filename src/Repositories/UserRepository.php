<?php

namespace App\Repositories;

use PDO;
use App\Models\User;
use App\Database\Database;

class UserRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function find($id) {
        $sql = 'SELECT * FROM users WHERE id = :id';
        return $this->db->fetchAll($sql, ['id' => $id]);
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
