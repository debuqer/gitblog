<?php


namespace Debuqer\Kati\Kernel;

use Debuqer\Kati\Http\Request;

class Http
{
    public function run(Request $request)
    {
        require routes_path();

        router()->run();
    }
}