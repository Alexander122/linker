<?php

namespace core\routes\Strategy;

use core\routes\AbstractStrategy;

/**
 * Class RouteUrlParser
 */
class RouteUrlParser extends AbstractStrategy
{
    public static function getUrl($param = 'route')
    {
        return isset($_GET[$param]) ? $_GET[$param] : null;
    }
}
