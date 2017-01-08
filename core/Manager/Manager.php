<?php

namespace core\Manager;

class Manager
{
    private function __construct() 
    {
        
    }
    
    /**
     * @param $module name of the module
     * @param $fileName name of the configuration file
     * @param $path path element in the file
     */
    public static function config($module, $fileName, $path = '')
    {
        $filePath = "../../$module/config/$fileName.php";
        if (file_exists($filePath)) {
            $result = require $filePath;
            if ($path == '')
                return $result;
                
            $elements = explode(".", $path);
            foreach ($elements as $value) {
                $result = $result[$value];
            }
            
            return $result;
        }
    }
    
    private function __clone() 
    {
        
    }
}
