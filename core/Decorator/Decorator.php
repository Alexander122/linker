<?php

namespace core\Decorator;

abstract class Decorator
{
    /**
     * Decorated component
     */
    protected $component;
    
    /**
     * Decorator construct
     */
    public function __construct($component)
    {
        $this->component = new $component;
    }
}
