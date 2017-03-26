<?php

namespace core\models;

use core\Database\MySQLiConnection;
use core\Database\DatabaseConfiguration;
use core\Manager\Manager;

class Model implements \SplSubject
{
    private $observers = [];
    
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
        // TODO внедрить тут DI
        $config = Manager::config('core', 'db');
        $databaseConfiguration = new DatabaseConfiguration($config);
        $db = MySQLiConnection::getInstance($databaseConfiguration);
        $this->mysqli = $db->getConnection();
    }
    
    public function attach(\SplObserver $observer)
    {
        $this->observers[] = $observer;
    }
    
    public function detach(\SplObserver $observer)
    {
        $this->observers[] = $observer;
    }
    
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
