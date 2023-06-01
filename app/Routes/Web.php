<?php


namespace App\Routes;


use Bramus\Router\Router;

class Web
{
    public function apply(Router $router)
    {
        $router->get('/article', function () {
            echo '1';
            return 1;
        });
    }
}