<?php 
    namespace App\models;

    use App\core\database;
    use PDO;

    class Delivery {
        private $pdo;

        public function __construct() {
            $this->pdo = database::connect();
        }

        public function getAll() {
            $stmt = $this->pdo->query("SELECT * FROM delivery");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addDelivery() {
            $stmt = $this->pdo->prepare("INSERT INTO delivery (delivery_name, delivery_price) VALUES (:delivery_name, :delivery_price)");
            $stmt->execute();
        }        
    }
?>