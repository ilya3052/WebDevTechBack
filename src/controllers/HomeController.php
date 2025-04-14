<?php 

namespace App\controllers;

class HomeController
{
    public function index() : void {
        require_once __DIR__ . '/../views/home.php';
    }
}

?>