<?php

namespace core\Base;

use core\DependencyInjection\Container;
use core\DependencyInjection\ServiceLocator;
use core\Linker;

class Application extends ServiceLocator
{
    public $config;

    public function __construct($config)
    {
        $this->config = (object)$config;
    }

    public function run()
    {
        Linker::$app = $this;
        Linker::$container = new Container($this->config->main);
        $this->bootstrap();
    }

    public function bootstrap()
    {
        $parser = \core\Manager\Manager::config('frontend', 'main', 'main.components.urlParser.class');
        $route = new \core\routes\Route(new $parser);
        $route->run();
    }
}
