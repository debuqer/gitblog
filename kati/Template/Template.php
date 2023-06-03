<?php


namespace Debuqer\Kati\Template;


use League\Plates\Engine;

class Template
{
    /** @var Engine */
    protected static $engine;

    /**
     * @return Engine
     */
    public static function get()
    {
        if ( ! static::$engine ) {
            static::$engine = new Engine(app_path('templates'));
            static::$engine->addFolder('layout', templates_path('layout'));
        }

        return static::$engine;
    }

    public static function render($template, $data = [])
    {
        Template::get()->render($template, $data);
    }
}