<?php

namespace core\Database;

class DatabaseConfiguration implements \ArrayAccess
{
    /**
     * @var string
     */
    private $_configuration;

    public function __construct($config)
    {
        $this->_configuration = $config;
    }
    
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->_configuration[] = $value;
        } else {
            $this->_configuration[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->_configuration[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->_configuration[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->_configuration[$offset]) ? $this->_configuration[$offset] : null;
    }
}
