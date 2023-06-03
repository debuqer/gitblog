<?php
namespace Debuqer\Kati\Http;

class Request extends \Symfony\Component\HttpFoundation\Request
{
    /**
     * @var Request
     */
    protected static $r;

    protected $appended;

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

    public function __get($name)
    {
        if ( str_starts_with($name, 'appended_') ) {
            return $this->appended[$name] ?? '';
        }

        return $this->{$name};
    }

    public function __set($name, $value)
    {
        if ( str_starts_with($name, 'appended_') ) {
            $this->appended[$name] = $value;
        } else {
            $this->{$name} = $value;
        }
    }
}