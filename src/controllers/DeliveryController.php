<?php

namespace App\controllers;

use App\models\Delivery;

use Twig\Environment;

use Twig\Loader\FilesystemLoader;

class DeliveryController
{
    private Delivery $deliveryModel;

    // Приватное свойство для работы с шаблонизатором Twig
    private Environment $twig;
    // Конструктор класса, вызывается при создании объекта UserController
    public function __construct()
    {
        // Создаёт объект модели User для взаимодействия с базой данных
        $this->deliveryModel = new Delivery();

        // Создаёт загрузчик шаблонов Twig, указывая путь к папке views
        $loader = new FilesystemLoader(__DIR__ . '/../views');

        // Создаёт объект Twig для рендеринга шаблонов
        $this->twig = new Environment($loader);
    }

    // Метод для обработки запроса GET /deliveries
    public function index(): void
    {
        // Получает список всех пользователей из базы данных
        $deliveries = $this->deliveryModel->getAll();

        // Рендерит шаблон users.twig и передаёт в него массив с доставками
        echo $this->twig->render('delivery.twig', [
            'data' => [
                'deliveries' => $deliveries,
                'styles' => "/assets/style.css",
                'phone_script' => "/assets/phoneinput.js",
                'main_script' => "/assets/index.js"
            ],
        ]);
    }

    // Метод для обработки запроса POST /deliveries/add (добавление доставки)
    public function store(): void
    {
        // Проверяет, что запрос был отправлен методом POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $client_name = trim($_POST['client_name'] ?? '');
            $client_phone = str_replace([' ', '(', ')', '-', '+'], '', trim($_POST['client_phone'] ?? ''));
            $client_mail = trim($_POST['client_mail'] ?? '');
            $courier_name = trim($_POST['courier_name'] ?? '');
            $product = trim($_POST['product'] ?? '');
            (float) $product_price = trim($_POST['product_price'] ?? '');
            $city = trim($_POST['city'] ?? '');
            $street = trim($_POST['street'] ?? '');
            $house = trim($_POST['house'] ?? '');
            $entrance = trim($_POST['entrance'] ?? '');
            $apartment = trim($_POST['apartment'] ?? '');
            $floor = trim($_POST['floor'] ?? '');
            $intercome_code = trim($_POST['intercome_code'] ?? '');
            $delivery_date = date('Y-m-d', strtotime(trim($_POST['delivery_date'] ?? '')));
            (float) $delivery_price = trim($_POST['delivery_price'] ?? '');

            $this->deliveryModel->addDelivery(
                $client_name,
                $client_phone,
                $client_mail,
                $courier_name,
                $product,
                $product_price,
                $city,
                $street,
                $house,
                $entrance,
                $apartment,
                $floor,
                $intercome_code,
                $delivery_date,
                $delivery_price
            );
        }
        // Перенаправляет пользователя обратно на страницу /users после добавления
        header("Location: /deliveries");
    }
}
