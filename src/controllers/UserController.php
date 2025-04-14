<?php 

namespace App\controllers;

class UserController
{
    public function login(): void {
        require_once __DIR__ . '/../views/login.php';
    }

    public function logout(): void {

    }

    public function registration(): void {
        require_once __DIR__ . '/../views/registration.php';
    }

    public function profile(): void {

    }
}
?>