<?php 
    namespace App\models;

    use App\core\database;
    use PDO;

    class Courier  {
        private $pdo;

        public function __construct() {
            $this->pdo = database::connect();
        }

        //добавляет курьера в базу
        public function addCourier(string $courier_name): int {
            $stmt = $this->pdo->prepare("INSERT INTO courier (courier_fullname) VALUES (:courier_name)");
            $stmt->execute([
                'courier_name' => htmlspecialchars($courier_name)
            ]);
            return $this->pdo->lastInsertId();
        }        
    }
?>