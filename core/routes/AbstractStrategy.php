<?php

namespace core\routes;

use core\Traits\CamelCaseTrait;

abstract class AbstractStrategy
{
    use CamelCaseTrait;
    
    abstract public static function getUrl($param);
    
    /**
     * @param $url
     * @return array
     */
    public static function parseUrl($camelCaseFormat = true)
    {
        $url = static::getUrl();
        if ($url) {
            $url = mb_strtolower($url);
            $url = explode('/', $url);
            if ($camelCaseFormat == false)
                return array_combine(
                    ['module', 'controller', 'action'], 
                    [$url[0], $url[1], $url[2]]
                );
            return array_combine(
                ['module', 'controller', 'action'], 
                [$url[0], self::parseCamelCase($url[1]), self::parseCamelCase($url[2])]
            );
        }
        
        return false;
    }
}
