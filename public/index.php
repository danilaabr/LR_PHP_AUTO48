<?php
require __DIR__ . '/../vendor/autoload.php';

use App\core\Router;
use App\controllers\CarController;
use App\controllers\ClientController;

$carController = new CarController();
$clientController = new ClientController();
$router = new Router();

$router->get('/', function() {
    include __DIR__ . '/../src/views/home.php';
});

$router->get('/cars', [$carController, 'list']);
$router->get('/cars/add', [$carController, 'showForm']);
$router->post('/cars/add', [$carController, 'addCar']);
$router->get('/clients', [$clientController, 'list']);
$router->resolve();