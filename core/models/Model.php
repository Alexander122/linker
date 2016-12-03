<?php

namespace core\models;

use core\db\Db;

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
        $config = require_once __DIR__.'/../configDb.php';
        $db = Db::getInstance($config);
        $this->mysqli = $db->getConnection();
    }
}
