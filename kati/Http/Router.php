<?php
namespace Debuqer\Kati\Http;

class Router extends \Bramus\Router\Router
{
    /**
     * @var Router
     */
    protected static $r;

    public static function make(): static
    {
        if ( ! static::$r ) {
            static::$r = new static();
        }

        return static::$r;
    }
}