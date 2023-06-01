<?php


namespace App\Routes;


use Bramus\Router\Router;
use League\Plates\Engine;

class Web
{
    protected $template;

    public function __construct()
    {
        $this->template = new Engine(__PUBLIC__.'/../app/templates');
    }

    public function apply(Router $router)
    {
        $router->get('/article', function () {
            echo $this->template->render('article');
        });

        $router->get('/author', function () {
            echo $this->template->render('author');
        });

        $router->get('/index', function () {
            echo $this->template->render('index');
        });
    }
}