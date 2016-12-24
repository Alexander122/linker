<?php

namespace core\models;

use core\Db\Db;

class Model
{
    /**
     * Connection to the database instance
     * @var \mysqli
     */
    public $mysqli;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        // TODO сделать подключение конфигурации через менеджер
        $config = require_once __DIR__ . '/../config/db.php';
        $db = Db::getInstance($config);
        $this->mysqli = $db->getConnection();
    }
}
