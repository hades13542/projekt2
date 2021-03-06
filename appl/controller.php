<?php

/**
 * Class controller
 */
abstract class controller
{

    /**
     * @var string przechowuje link do CSS
     */
    protected $css;

    /**
     * controller constructor.
     */
    function __construct()
    {
        $this->css = '<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" >';
    }

    /**
     *Funkcja wywolujaca error 404
     */
    static function http404()
    {
        header('HTTP/1.1 404 Not Found');
        print '<!doctype html><html><head><title>404 Not Found</title></head><body><p>Invalid URL</p></body></html>';
        exit;
    }

    /**
     * @param $name
     * @param $arguments
     */
    function __call($name, $arguments)
    {
        self::http404();
    }
}
