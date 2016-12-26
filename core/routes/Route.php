<?php

namespace core\routes;

use core\Decorator\ControllerDecorator;

/**
 * Class Rout
 */
class Route
{
    protected $parser;
    protected $url = [];

    /**
     * Route constructor.
     */
    public function __construct(AbstractStrategy $parser)
    {
        $this->parser = $parser;
        $this->init();
    }
    
    public function __get($name)
    {
        if (in_array($name, ['module', 'controller', 'action']) && array_key_exists($name, $this->url))
            return $this->url[$name];
        
        return $this->$name;
    }
    
    public function __set($name, $value)
    {
        if (in_array($name, ['module', 'controller', 'action']) && array_key_exists($name, $this->url))
            $this->url[$name] = $value;
    }

    /**
     * Routing initialization of variables
     */
    public function init()
    {
        $parser = $this->parser;
        $this->url = $parser::parseUrl();
        $this->controller = "{$this->controller}Controller";
        $this->action = "action{$this->action}";
    }

    /**
     * Route start
     */
    public function run()
    {
        // TODO реализовать роутинг по рулсам
        require_once "../../{$this->module}/controllers/{$this->controller}.php";
        $namespace = "{$this->module}\\controllers\\{$this->controller}";
        $decorator = new ControllerDecorator(new $namespace);
        $decorator->operations($this->action);
    }
}
