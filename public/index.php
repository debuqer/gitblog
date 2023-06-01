<?php


// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->get('/article/(\w+)', function () {

});

$router->run();