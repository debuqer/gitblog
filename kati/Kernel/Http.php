<?php


namespace Debuqer\Kati\Kernel;


use App\Routes\Web;
use Bramus\Router\Router;
use Debuqer\Kati\Http\Request;

class Http
{
    protected $router;
    protected $routes;

    protected $template;

    public function __construct(Router $router, Web $routes)
    {
        $this->router = $router;
        $this->routes = $routes;
    }

    public function run(Request $request)
    {
        $this->routes->apply($this->router);

        $this->router->run();
    }
}