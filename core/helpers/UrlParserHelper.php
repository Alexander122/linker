<?php

namespace core\helpers;

/**
 * Class UrlParserHelper
 */
class UrlParserHelper
{
    /**
     * It causes any URL to the form
     * [
     *      'module' => 'camel-case'
     *      'controller' => 'camelCaseController'
     *      'action' => 'actionCamelCase'
     * ]
     *
     * @param $url
     * @return array
     */
    public static function parseRequestUrl($url)
    {
        $url = mb_strtolower($url);
        $url = explode('/', $url);
        array_shift($url);
        // $url = [
        //     'module' => isset($url[0]) ? $url[0] : false,
        //     'controller' => isset($url[1]) ? self::parseCamelCaseParser($url[1])."Controller" : false,
        //     'action' => isset($url[2]) ? "action".self::parseCamelCaseParser($url[2]) : false
        // ];
        $url = [
            'module' => false,
            'controller' => "DefaultController",
            'action' => "actionIndex"
        ];
        return $url;
    }

    /**
     * Leads name default-controller to the form DefaultController
     *
     * @param $item
     * @return mixed
     */
    public static function parseCamelCaseParser($item)
    {
        $piece = explode('-', $item);
        $piece = array_map(function ($value) {
            return ucfirst($value);
        }, $piece);
        $piece = implode('', $piece);
        
        return $piece;
    }
}
