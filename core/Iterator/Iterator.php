<?php

namespace core\Iterator;

class Iterator implements \Iterator
{
    private $_items = array();

    public function __construct(array $items)
    {
        $this->_items = $items;
    }

    public function next()
    {
        var_dump('fun:next');
        return next($this->_items);
    }

    public function valid()
    {
        var_dump('fun:valid');
        return isset($this->_items[$this->key()]);
    }

    public function current()
    {
        var_dump('fun:current');
        return current($this->_items);
    }

    public function key()
    {
        var_dump('fun:key');
        return key($this->_items);
    }

    public function rewind()
    {
        var_dump('fun:rewind');
        return reset($this->_items);
    }
}
