<?php

namespace core\db;

use mysqli;

/**
 * Class Db
 */
class Db
{
    /**
     * @var mysqli
     */
    private $_connection;

    /**
     * Singleton instance of class
     * @var
     */
    private static $_instance;

    /**
     * @var string
     */
    private $_host;

    /**
     * @var string
     */
    private $_username;

    /**
     * @var string
     */
    private $_password;

    /**
     * @var string
     */
    private $_database;

    /**
     * Db constructor.
     * @param $config
     */
    private function __construct($config) {
        $this->_host = $config['host'];
        $this->_username = $config['username'];
        $this->_password = $config['password'];
        $this->_database = $config['database'];
        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
        $this->_connection->set_charset("utf8");

        if(mysqli_connect_error()) {
            trigger_error("Failed connect to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
        }
    }

    /**
     * Singleton class
     * @param $config
     * @return Db
     */
    public static function getInstance($config) {
        if(!self::$_instance) {
            self::$_instance = new self($config);
        }

        return self::$_instance;
    }

    /**
     * @return mysqli
     */
    public function getConnection() {
        return $this->_connection;
    }
    
    /**
     * Prevents clone singleton instance
     */
    private function __clone() { }
}
