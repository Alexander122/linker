<?php

namespace core\routes;

use core\Traits\CamelCaseTrait;

abstract class AbstractStrategy
{
    use CamelCaseTrait;
    
    protected $url = [];
    
    public abstract function parseUrl();
    
    public function __get($name)
    {
        if (array_key_exists($name, $this->url))
            $value = $this->url[$name];
            
        return isset($value) ? $value : null;
    }
}
