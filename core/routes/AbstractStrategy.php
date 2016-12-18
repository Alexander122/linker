<?php

namespace core\routes;

use core\Traits\CamelCaseTrait;

abstract class AbstractStrategy
{
    use CamelCaseTrait;
    
    abstract public function parseUrl();
}
