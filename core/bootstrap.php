<?php

$parser = \core\Manager\Manager::config('core', 'main', 'urlParser');
$route = new \core\routes\Route(new $parser);
$route->run();
