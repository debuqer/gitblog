<?php


namespace Debuqer\Kati\Kernel;

use Debuqer\Kati\Http\Request;
use Debuqer\Kati\Http\Response;

class Http
{
    public function run(Request $request)
    {
        require routes_path();

        router()->run(function () {
            echo Response::make()->getContent();
        });
    }
}