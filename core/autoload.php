<?php
spl_autoload_register(function ($class) {
    $basePath = substr(__DIR__, 0, -4);
    $path = explode('\\', $class);
    $path = $basePath.implode('/', $path).'.php';
    require_once $path;
});
