<?php
use Debuqer\Kati\Kernel\Http;
use Debuqer\Kati\Http\Request;
use \Debuqer\Kati\Template\Template;
use Debuqer\Kati\Http\Router;

define('__PUBLIC__', __DIR__);
define('__APP__', __PUBLIC__.'/../app/');
define('__ROUTES__', __PUBLIC__.'/../routes/');
define('__TEMPLATES__', __APP__.'/templates/');

function public_path($path)
{
    return __PUBLIC__.'/'.$path;
}

function app_path($path = '')
{
    return __APP__.'/'.$path;
}

/**
 * @return \League\Plates\Engine
 */
function template()
{
    return Template::get();
}

function router()
{
    return Router::make();
}

// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

$kernel = new Http();

$kernel->run(Request::make());