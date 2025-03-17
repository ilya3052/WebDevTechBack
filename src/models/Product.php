<?php 
    namespace App\models;

    use App\core\database;
    use PDO;

    class Product  {
        private $pdo;

        public function __construct() {
            $this->pdo = database::connect();
        }

        //добавляет товар в базу
        public function addProduct(string $product_name, int $product_price): int {
            $stmt = $this->pdo->prepare("INSERT INTO product (product_name, product_price) VALUES (:product_name, :product_price)");
            $stmt->execute([
                'product_name' => htmlspecialchars($product_name),
                'product_price' => $product_price
            ]);
            return $this->pdo->lastInsertId();
        }        
    }
?>