<?php 
    namespace App\models;

    use App\core\database;
    use PDO;

    class Client  {
        private $pdo;

        public function __construct() {
            $this->pdo = database::connect();
        }

        //добавляет клиента в базу
        public function addClient(string $client_fullname, string $client_phonenumbmer, string $client_mail): int {
            $stmt = $this->pdo->prepare("INSERT INTO client (client_fullname, client_phonenumber, client_mail) VALUES (:client_fullname, :client_phonenumber, :client_mail)");
            $stmt->execute([
                'client_fullname' => htmlspecialchars($client_fullname),
                'client_phonenumber' => $client_phonenumbmer,
                'client_mail' => filter_var($client_mail, FILTER_SANITIZE_EMAIL)
            ]);
            return $this->pdo->lastInsertId();
        }        
    }
?>