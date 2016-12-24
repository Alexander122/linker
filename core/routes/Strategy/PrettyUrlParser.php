<?php

namespace core\routes\Strategy;

use core\routes\AbstractStrategy;

/**
 * Class PrettyUrlParser
 */
class PrettyUrlParser extends AbstractStrategy
{
    public static function getUrl($param = 'PATH_INFO')
    {
        return isset($_SERVER[$param]) ? substr($_SERVER[$param], 1) : null;
    }
}
