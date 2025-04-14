<?php
namespace App\controllers;

use App\models\User;
use App\models\Client;

session_start();

class UserController
{
    private $userModel;
    private $clientModel;

    public function __construct() {
        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../models/Client.php';
        
        $this->userModel = new User();
        $this->clientModel = new Client();
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $user = $this->userModel->getUserByEmail($email);
            $client = $this->clientModel->getClientByUserId($user['user_id']);

            if ($user && password_verify($password, $user['user_password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['client_id'] = $client['client_id'];
                $_SESSION['email'] = $user['user_email'];
                $_SESSION['role'] = $user['user_role'];
                header("Location: /profile");
                exit;
            } else {
                echo "Неверный email или пароль";
            }
        }
        require_once __DIR__ . '/../views/login.php';
    }

    public function logout(): void 
    {
        session_unset();
        session_destroy();
        header("Location: /login");
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $name = trim($_POST['name']);
            $phonenumber = trim($_POST['phonenumber']);
            
            $user_id = $this->userModel->createUser($email, $password);
            $user = $this->userModel->getUserById($user_id);

            $this->clientModel->createClient($user_id, $name, $phonenumber, $email);
            $client = $this->clientModel->getClientByUserId($user['user_id']);

            if ($user && password_verify($password, $user['user_password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['user_email'];
                $_SESSION['client_id'] = $client['client_id'];
                $_SESSION['role'] = 'user';
                header("Location: /profile");
                exit;
            } else {
                $error = "Неверный email или пароль";
            }
        }
        require_once __DIR__ . '/../views/register.php';
    }

    public function profile(): void 
    {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $user = $this->userModel->getUserById($user_id);
            $client = $this->clientModel->getClientByUserId($user_id);

            $_SESSION['client_name'] = $client['client_fullname'];
            $_SESSION['client_phonenumber'] = $client['client_phonenumber'];
            $_SESSION['client_email'] = $user['user_email'];
            
            require_once __DIR__ . '/../views/profile.php';
        } else {
            header("Location: /login");
            exit;
        }
    }
}