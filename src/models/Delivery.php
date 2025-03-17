<?php

namespace App\models;

use App\core\database;
use PDO;

class Delivery
{
    private $pdo;
    private $errors = [];

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
            $client_name = trim($_POST['client_name'] ?? '');
            $client_phone = str_replace([' ', '(', ')', '-', '+'], '', trim($_POST['client_phone'] ?? ''));
            $client_mail = trim($_POST['client_mail'] ?? '');
            $courier_name = trim($_POST['courier_name'] ?? '');
            $product_name = trim($_POST['product'] ?? '');
            $product_price = trim($_POST['product_price'] ?? '');
            $city = trim($_POST['city'] ?? '');
            $street = trim($_POST['street'] ?? '');
            $house = trim($_POST['house'] ?? '');
            $entrance = trim($_POST['entrance'] ?? '');
            $apartment = trim($_POST['apartment'] ?? '');
            $floor = trim($_POST['floor'] ?? '');
            $intercome_code = trim($_POST['intercome_code'] ?? '');
            $delivery_date = date('Y-m-d', strtotime(trim($_POST['delivery_date'] ?? '')));
            $delivery_price = trim($_POST['delivery_price'] ?? '');

            if (empty($client_name) || strlen($client_name) > 100 || hasNumber($client_name)) {
                $this->errors[] = 'Укажите корректное имя клиента';
            }

            if (empty($client_phone) || strlen($client_phone) < 11) {
                $this->errors[] = 'Укажите корректный номер телефона';
            }

            if (empty($courier_name) || strlen($courier_name) > 100 || hasNumber($courier_name)) {
                $this->errors[] = 'Укажите корректное имя курьера';
            }

            if (empty($client_mail) || !isValidEmailDomain($client_mail)) {
                $this->errors[] = "Укажите корректный адрес электронной почты";
            }

            if (empty($product_name)) {
                $this->errors[] = 'Укажите коректное название товара';
            }

            if (empty($product_price) || hasLetter($product_price) || $product_price < 1) {
                $this->errors[] = 'Укажите корректную цену';
            }

            if (empty($city)) {
                $this->errors[] = 'Укажите город';
            }

            if (empty($street)) {
                $this->errors[] = 'Укажите улицу';
            }

            if (empty($house) || !is_numeric($house[0]) || !hasNumber($house) || hasSpecial($house[0])) {
                $this->errors[] = 'Укажите корректный номер дома';
            }

            if ((strlen($entrance) > 0 && $entrance < 1) || hasLetter($entrance) || hasSpecial($entrance)) {
                $this->errors[] = 'Укажите корректный номер подъезда';
            }

            if (!empty($apartment)) {
                if (hasLetter($apartment) || !hasNumber($apartment) || hasSpecial($apartment[0])) {
                    $this->errors[] = 'Укажите корректный номер квартиры';
                }
            }

            if ((strlen($floor) > 0 && $floor < 1) || hasLetter($floor) || hasSpecial($floor)) {
                $this->errors[] = 'Укажите корректный этаж';
            }

            if (empty($delivery_date)) {
                $this->errors[] = 'Укажите дату доставки';
            }

            if (empty($delivery_price) || $delivery_price < 1 || hasLetter($delivery_price) || hasSpecial($delivery_price)) {
                $this->errors[] = 'Укажите корректную цену доставки';
            }

            // добавляем клиента (покупателя)
            $client = new Client();
            $client_id = $client->addClient($client_name, $client_phone, $client_mail);

            // добавляем курьера
            $courier = new Courier();
            $courier_id = $courier->addCourier($courier_name);

            // добавляем товар
            $product = new Product();
            $article = $product->addProduct($product_name, $product_price);

            // создаем запись о доставке
            $stmt = $this->pdo->prepare("
            INSERT INTO delivery (
                client_id, courier_id, delivery_city, delivery_street, delivery_house, delivery_entrance, 
                delivery_apartment, delivery_floor, delivery_intercome_code, delivery_date, delivery_price
            ) VALUES (:client_id, :courier_id, :delivery_city, :delivery_street, :delivery_house, :delivery_entrance, 
                :delivery_apartment, :delivery_floor, :delivery_intercome_code, :delivery_date, :delivery_price)");
            $stmt->execute([$client_id, $courier_id, $city, $street, $house, empty($entrance) ? NULL : $entrance, empty($apartment) ? NULL : $apartment,
                empty($floor) ? NULL : $floor, empty($intercome_code) ? NULL : $intercome_code, $delivery_date, $delivery_price]);
            $delivery_number = $this->pdo->lastInsertId();

            // связываем товар с доставкой
            $stmt = $this->pdo->prepare("INSERT INTO included (product_article, delivery_number) VALUES (:product_article, :delivery_number)");
            $stmt->execute([$article, $delivery_number]);
        }
    }
}
