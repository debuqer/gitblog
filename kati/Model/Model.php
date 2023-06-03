<?php


namespace Debuqer\Kati\Model;


class Model
{
    protected $attributes;

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? '';
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }
}