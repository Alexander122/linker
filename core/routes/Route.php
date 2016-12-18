<?php

namespace core\routes;

use core\helpers\UrlParserHelper;
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

    /**
     * Routing initialization of variables
     */
    public function init()
    {
        $this->url = $this->parser->parseUrl();
    }

    /**
     * Route start
     */
    public function run()
    {
        require_once "../../{$this->module}/controllers/{$this->controller}Controller.php";
        $namespace = "{$this->module}\\controllers\\{$this->controller}Controller";
        $decorator = new ControllerDecorator(new $namespace);
        $action = "action{$this->action}";
        $decorator->operations($action);
    }
}
