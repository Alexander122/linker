<?php

namespace core\Manager;

class Config
{
    private function __construct() { }
    
    public static function __callStatic($name, $arguments)
    {
        $path = "../../$name/Config/" . ucfirst($arguments[0]) . ".php";
        if (file_exists($path)) {
            return require_once $path;
        }
    }
    
    private function __clone() { }
}
