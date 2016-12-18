<?php

namespace core\routes\Strategy;

use core\routes\AbstractStrategy;

class RouteUrlParser extends AbstractStrategy
{
    /**
     * @param $url
     * @return array
     */
    public function parseUrl()
    {
        $url = isset($_GET['route']) ? $_GET['route'] : null;
        if ($url) {
            $url = mb_strtolower($url);
            $url = explode('/', $url);
            $url = array_combine(
                ['module', 'controller', 'action'], 
                [$url[0], $this->parseCamelCase($url[1]), $this->parseCamelCase($url[2])]
            );
        }
        
        return $url;
    }
}
