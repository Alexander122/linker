<?php

namespace core\Database;

use mysqli;

// TODO реализовать подключение к другим БД и доработать внедрение зависимостей
/**
 * Class MySQLiConnection
 */
class MySQLiConnection
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
    private $_configuration;

    /**
     * Db constructor.
     * @param $config
     */
    private function __construct(DatabaseConfiguration $databaseConfiguration) {
        $this->_configuration = $databaseConfiguration;
        $this->_connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        $this->_connection->set_charset("utf8");
    }
    
    public function __get($name)
    {
        if (in_array($name, ['host', 'username', 'password', 'database']) && isset($this->_configuration[$name]))
            return $this->_configuration[$name];
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
