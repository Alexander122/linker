<?php

namespace core\Manager;

class Manager
{
    private function __construct() 
    {
        
    }

    /**
     * Returns configuration file if the $path, a not specified
     * or an element of the configuration file, if the $path, a set.
     * $path parameter must be of the form array_element_1.array_element_2.array_element_3...
     *
     * @param $module
     * @param $fileName
     * @param string $path
     * @return mixed|null
     */
    public static function config($module, $fileName, $path = '')
    {
        $filePath = "../../$module/config/$fileName.php";
        if (!file_exists($filePath)) {
            return null;
        }

        $result = require $filePath;
        return !empty($path) ? self::getElementByPath($result, $path) : $result;
    }

    /**
     * Returns the array element in the configuration file
     *
     * @param $result
     * @param $path
     * @return mixed|null
     */
    public static function getElementByPath($result, $path)
    {
        if (!is_array($result)) {
            return null;
        }

        $elements = explode(".", $path);
        if (!is_array($elements)) {
            return null;
        }

        foreach ($elements as $value) {
            if (!array_key_exists($value, $result)) {
                return null;
            }
            $result = $result[$value];
        }

        return $result;
    }
    
    private function __clone() 
    {
        
    }
}
