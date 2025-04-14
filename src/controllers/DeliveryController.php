<?php

namespace App\controllers;

use App\models\Delivery;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class DeliveryController
{
    private Delivery $deliveryModel;
    private Environment $twig;

    public function __construct()
    {
        $this->deliveryModel = new Delivery();
        $loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($loader);
    }

    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        $deliveries = $this->deliveryModel->getAll($_SESSION['client_id']);
        
        echo $this->twig->render('delivery.twig', [
            'data' => [
                'deliveries' => $deliveries,
                'styles' => "/assets/style.css",
                'phone_script' => "/assets/phoneinput.js",
                'main_script' => "/assets/index.js"
            ],
        ]);
    }

    public function store(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $client_id = $_SESSION['client_id'];
            $courier_name = trim($_POST['courier_name'] ?? '');
            $product = trim($_POST['product'] ?? '');
            $product_price = (float)trim($_POST['product_price'] ?? '');
            $city = trim($_POST['city'] ?? '');
            $street = trim($_POST['street'] ?? '');
            $house = trim($_POST['house'] ?? '');
            $entrance = trim($_POST['entrance'] ?? '');
            $apartment = trim($_POST['apartment'] ?? '');
            $floor = trim($_POST['floor'] ?? '');
            $intercome_code = trim($_POST['intercome_code'] ?? '');
            $delivery_date = date('Y-m-d', strtotime(trim($_POST['delivery_date'] ?? '')));
            $delivery_price = (float)trim($_POST['delivery_price'] ?? '');

            $this->deliveryModel->addDelivery(
                $client_id,
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

        header("Location: /deliveries");
        exit;
    }
}