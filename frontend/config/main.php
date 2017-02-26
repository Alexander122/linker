<?php
return [
    'main' => [
        'components' => [
            // TODO сделать db зависимым от DatabaseConfiguration, а DatabaseConfiguration от параметров (host, username...)
            'db' => [
                'class' => 'core\Database\MySQLiConnection',
                'params' => [
                    'host' => 'localhost',
                    'username' => 'root',
                    'password' => 'root',
                    'database' => 'linker',
                ],
            ],
            'urlParser' => [
                'class' => '\core\routes\Strategy\PrettyUrlParser',
            ],
        ],
    ],
];
