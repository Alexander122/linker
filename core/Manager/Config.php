<?php

namespace core\Manager;

class Config
{
    private function __construct() 
    {
        
    }
    
    /**
     * @param $name it is name of the module
     * @param $arguments it is name of the configuration file
     */
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
