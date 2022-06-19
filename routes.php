<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use controllers\OrderController;

$router = new Router();

$router->get('/accessRoute', function () {
    echo 'Welcome';
});

$router->post('/place_orderS', function () {
    $controller = new OrderController();
    $controller->placeOrder($_POST);
});

// Thunderbirds are go!
$router->run();
