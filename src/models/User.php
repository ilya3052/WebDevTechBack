<?php

namespace App\models;

use App\core\database;
use PDO;

class User
{
    private $pdo;
    private $errors = [];

    public function __construct()
    {
        $this->pdo = database::connect();
    }

    public function createUser($email, $password)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO users 
                (user_email, user_password, user_role) 
            VALUES 
                (?, ?, ?)
        ");
        
        $stmt->execute([
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            'user'
        ]);
        
        return $this->pdo->lastInsertId();
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("
            SELECT * 
            FROM users 
            WHERE user_email = ?
        ");
        
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT * 
            FROM users 
            WHERE user_id = ?
        ");
        
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}