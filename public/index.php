<?php
use  \Bramus\Router\Router;
use Debuqer\Kati\Kernel\Http;
use Debuqer\Kati\Http\Request;
use App\Routes\Web;


define('__PUBLIC__', __DIR__);

// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

$kernel = new Http(new Router, new Web);

$kernel->run(Request::make());