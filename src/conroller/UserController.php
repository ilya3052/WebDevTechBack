<?php 
    namespace App\controllers;
    
    use App\models\User;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    class UserController {
        private User $userModel;
        private Environment $twig;

        public function __construct() {
            $this->userModel = new User();
            $loader = new FilesystemLoader(__DIR__ . '/../views');
            $this->twig = new Environment($loader);
        }

        public function index(): void {
            $users = $this->$userModel->getAll();

            echo $this->twig->render('users.twig', ['users' => $users]);
        }

        public function store(): void {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->userModel->addUser($_POST['name'], $_POST['email'], $_POST['password']);
                header('Location: /users');
                exit();
            }
        }
    }
?>