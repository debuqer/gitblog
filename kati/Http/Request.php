<?php
namespace Debuqer\Kati\Http;

class Request extends \Symfony\Component\HttpFoundation\Request
{
    /**
     * @var Request
     */
    protected static $r;

    public static function make(): static
    {
        if ( ! static::$r ) {
            static::$r = new static(
                $_GET,
                $_POST,
                [],
                $_COOKIE,
                $_FILES,
                $_SERVER
            );
        }

        return static::$r;
    }
}