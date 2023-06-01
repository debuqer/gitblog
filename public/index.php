<?php


// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();
$request = new \Symfony\Component\HttpFoundation\Request(
    $_GET,
    $_POST,
    [],
    $_COOKIE,
    $_FILES,
    $_SERVER
);

$router->get('/article/(\w+)', function () use($request) {

});

$router->run();