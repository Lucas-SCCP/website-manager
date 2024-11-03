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
        $sql = 'INSERT INTO users () VALUES ()';
    }

    public function update()
    {
        $sql = 'UPDATE users SET name = 1 WHERE id = 1';
    }

    public function delete()
    {
        $sql = 'DELETE FROM users WHERE id = 1';
    }
}
