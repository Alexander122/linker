<?php

namespace core\routes\Strategy;

use core\routes\AbstractStrategy;

/**
 * Class UrlParserHelper
 */
class PrettyUrlParser extends AbstractStrategy
{
    /**
     * @param $url
     * @return array
     */
    public function parseUrl()
    {
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null;
        if ($url) {
            $url = mb_strtolower($url);
            $url = explode('/', $url);
            array_shift($url);
            // $url = [
            //     'module' => isset($url[0]) ? $url[0] : false,
            //     'controller' => isset($url[1]) ? self::parseCamelCaseParser($url[1])."Controller" : false,
            //     'action' => isset($url[2]) ? "action".self::parseCamelCaseParser($url[2]) : false
            // ];
            $this->url = array_combine(
                ['module', 'controller', 'action'], 
                [$url[0], $this->parseCamelCase($url[1]), $this->parseCamelCase($url[2])]
            );
            $url = [
                'module' => false,
                'controller' => "DefaultController",
                'action' => "actionIndex"
            ];
        }
        
        return $url;
    }
}
