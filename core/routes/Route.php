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

    /**
     * Route constructor.
     */
    public function __construct(AbstractStrategy $parser)
    {
        $this->parser = $parser;
        $this->init();
    }

    /**
     * Routing initialization of variables
     */
    public function init()
    {
        $this->parser->parseUrl();
    }

    /**
     * Route start
     */
    public function run()
    {
        require_once "../../{$this->parser->module}/controllers/{$this->parser->controller}Controller.php";
        $namespace = "{$this->parser->module}\\controllers\\{$this->parser->controller}Controller";
        $decorator = new ControllerDecorator(new $namespace);
        $action = "action{$this->parser->action}";
        $decorator->operations($action);
    }
}
