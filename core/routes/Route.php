<?php

namespace core\routes;

use core\helpers\UrlParserHelper;
use core\Decorator\ControllerDecorator;

/**
 * Class Rout
 */
class Route
{
    public $module = 'frontend';
    public $controller = 'Default';
    public $action = 'Index';

    /**
     * Route constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Routing initialization of variables
     */
    public function init()
    {
        if ($_SERVER['REQUEST_URI']) {
            $url                = UrlParserHelper::parseRequestUrl($_SERVER['REQUEST_URI']);
            $this->module       = $url['module']        ? $url['module']        : $this->module;
            $this->controller   = $url['controller']    ? $url['controller']    : "{$this->controller}Controller";
            $this->action       = $url['action']        ? $url['action']        : "action{$this->action}";
        }
    }

    /**
     * Route start
     */
    public function run()
    {
        require_once "../../$this->module/controllers/$this->controller.php";
        $namespace = "$this->module\\controllers\\$this->controller";
        $decorator = new ControllerDecorator(new $namespace);
        $decorator->operations($this->action);
    }
}
