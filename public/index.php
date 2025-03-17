<?php
require __DIR__ . '/../vendor/autoload.php';

use App\core\Router;
use App\controllers\DeliveryController;

$delivery = new DeliveryController();

$router = new Router();

$router->get('/deliveries', [$delivery, 'index']);

$router->post('/deliveries/add', [$delivery, 'store']);

$router->resolve();
?>