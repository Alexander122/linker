<?php

$parser = \core\Manager\Config::core('main')['urlParser'];
$route = new \core\routes\Route(new $parser);
$route->run();
    