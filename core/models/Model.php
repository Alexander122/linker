<?php

namespace core\models;

use core\Database\MySQLiConnection;
use core\Database\DatabaseConfiguration;
use core\Manager\Config;

class Model
{
    /**
     * Connection to the database instance
     * @var \mysqli
     */
    protected $mysqli;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $config = Config::core('db');
        $databaseConfiguration = new DatabaseConfiguration($config);
        $db = MySQLiConnection::getInstance($databaseConfiguration);
        $this->mysqli = $db->getConnection();
    }
}
