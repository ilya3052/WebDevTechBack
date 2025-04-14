<?php
require __DIR__ . '/../vendor/autoload.php';

use App\core\Router;
use App\controllers\DeliveryController;
use App\controllers\HomeController;
use App\controllers\ReportController;
use App\controllers\UserController;

$delivery = new DeliveryController();

$home = new HomeController();

$user = new UserController();

$report = new ReportController();

$router = new Router();

$router->get('/', [$home, 'index']);

$router->get('/login', [$user, 'login']);
$router->post('/login', [$user, 'login']);

$router->get('/logout', [$user, 'logout']);

$router->get('/register', [$user, 'register']);
$router->post('/register', [$user, 'register']);

$router->get('/profile', [$user, 'profile']);
$router->get('/deliveries', [$delivery, 'index']);

$router->post('/deliveries/add', [$delivery, 'store']);

$router->get('/report', [$report, 'generateReport']);

$router->resolve();
?>

