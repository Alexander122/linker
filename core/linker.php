<?php

namespace core;

use core\DependencyInjection\Container;

/**
 * Class Linker
 * @package core
 */
class Linker
{
    public static $app;

    public static $container;

    public static function autoload($className)
    {
        $basePath = substr(__DIR__, 0, -4);
        $path = explode('\\', $className);
        $path = $basePath . implode('/', $path) . '.php';

        require_once $path;
    }
}

spl_autoload_register(['core\Linker', 'autoload']);
