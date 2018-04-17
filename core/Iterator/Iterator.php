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
        return next($this->_items);
    }

    public function valid()
    {
        return isset($this->_items[$this->key()]);
    }

    public function current()
    {
        return current($this->_items);
    }

    public function key()
    {
        return key($this->_items);
    }

    public function rewind()
    {
        return reset($this->_items);
    }
}
