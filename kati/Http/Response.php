<?php


namespace Debuqer\Kati\Http;


class Response extends \Symfony\Component\HttpFoundation\Response
{
    protected static $r;

    public static function make(): static
    {
        if ( ! static::$r ) {
            static::$r = new static('', 404, []);
        }

        return static::$r;
    }
}