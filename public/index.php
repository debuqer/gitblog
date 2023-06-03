<?php
use Debuqer\Kati\Kernel\Http;
use Debuqer\Kati\Http\Request;

// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helpers/app.php';

$dotenv = Dotenv\Dotenv::createMutable(root_path());
$dotenv->load();

$kernel = new Http();

$kernel->run(Request::make());