<?php

namespace core\Database;

// TODO попробывать реализовать где-то интерфейс IteratorAggregate, Countable (разобраться с паттерном Итератор). К примеру, можно реализовать коллекцию, если запрос возвращает больше одного результата
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
