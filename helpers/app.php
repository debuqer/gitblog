<?php


use \Debuqer\Kati\Template\Template;
use Debuqer\Kati\Http\Router;
use \Debuqer\Kati\Http\Request;

define('__ROOT__', __DIR__.'/../');

function root_path($path = '')
{
    return __ROOT__.'/'.$path;
}

function url($url = '')
{
    return $_ENV['app_url'].'/'.$url;
}

function public_path($path = '')
{
    return root_path('public/'.$path);
}

function app_path($path = '')
{
    return root_path('app/'.$path);
}

function config_path($path = '')
{
    return root_path('config/'.$path);
}

function routes_path()
{
    return app_path('routes.php');
}

function templates_path($path = '')
{
    return root_path('templates/'.$path);
}

function repo_path($path = '')
{
    return __ROOT__.$_ENV['repo'].$path;
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

function user()
{
    return Request::make()->appended_user;
}
