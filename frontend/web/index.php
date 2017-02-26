<?php
// TODO адаптировать проект под PHP7
$error_reporting = false;
if ($error_reporting) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

require_once '../../core/linker.php';

$config = array_merge(
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/params.php')
);

$application = new core\Base\Application($config);
$application->run();

// TODO
/*
 * 1. Реализовать класс Linker
 * 2. Реализовать класс приложения (он же ServiceLocator)
 * 3. Реализовать контейнер внедрения зависимостей
 */
