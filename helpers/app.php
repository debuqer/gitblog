<?php


use \Debuqer\Kati\Template\Template;
use Debuqer\Kati\Http\Router;

define('__ROOT__', __DIR__.'/../');

function root_path($path = '')
{
    return __ROOT__.'/'.$path;
}

function url($url = '')
{
    return 'http://'.$_SERVER['HTTP_PROTO'].$_SERVER['HTTP_HOST'].'/'.$url;
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

function routes_path($path = '')
{
    return root_path('routes/'.$path);
}

function templates_path($path = '')
{
    return root_path('templates/'.$path);
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
