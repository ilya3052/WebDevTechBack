<?php

namespace App\models;

use App\core\database;
use App\models\Client;
use PDO;

require 'Client.php';

class Delivery
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = database::connect();
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM delivery");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addDelivery()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $client = new Client();
            $client_name = trim($_POST['client_name'] ?? '');
            $client_phone = str_replace([' ', '(', ')', '-', '+'], '', trim($_POST['client_phone'] ?? ''));
            $client_mail = trim($_POST['client_mail'] ?? '');
            $client_id = $client->addClient($client_name, $client_phone, $client_mail);
            // по очереди добавляем клиента курьра и продукт
            $stmt = $this->pdo->prepare("INSERT INTO delivery (delivery_name, delivery_price) VALUES (:delivery_name, :delivery_price)");
            $stmt->execute();
        }
    }
}
