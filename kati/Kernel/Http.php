<?php


namespace Debuqer\Kati\Kernel;

use Debuqer\Kati\Http\Request;

class Http
{
    public function run(Request $request)
    {
        require __ROUTES__.'/web.php';

        router()->run();
    }
}