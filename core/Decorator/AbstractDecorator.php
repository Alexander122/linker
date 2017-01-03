<?php

namespace core\Decorator;

abstract class AbstractDecorator
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
        $this->component = $component;
    }
}
