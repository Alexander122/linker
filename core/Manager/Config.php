<?php

namespace core\Manager;

class Config
{
    private function __construct() 
    {
        
    }
    
    public static function __callStatic($name, $arguments)
    {
        $path = "../../$name/config/" . $arguments[0] . ".php";
        if (file_exists($path)) {
            return require $path;
        }
    }
    
    private function __clone() 
    {
        
    }
}
