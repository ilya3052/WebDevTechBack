<?php
namespace App\models;

use App\core\database;
use PDO;

class Client
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = database::connect();
    }

    public function createClient(int $user_id, string $client_fullname, string $client_phonenumber, string $client_mail)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO client 
                (user_id, client_fullname, client_phonenumber, client_mail) 
            VALUES 
                (:user_id, :client_fullname, :client_phonenumber, :client_mail)
        ");
        
        $stmt->execute([
            'user_id' => $user_id, 
            'client_fullname' => htmlspecialchars($client_fullname),
            'client_phonenumber' => $client_phonenumber,
            'client_mail' => filter_var($client_mail, FILTER_SANITIZE_EMAIL)
        ]);
    }

    public function getClientByUserId(int $user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM client WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}