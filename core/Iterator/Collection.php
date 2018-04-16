<?php

namespace core\Iterator;

class Collection implements \IteratorAggregate
{
    private $_items = array();
    
    public function addItem(array $item)
    {
        $this->_items = array_merge($this->_items, $item);
    }
    
    public function getItems()
    {
        return $this->_items;
    }
    
    public function getIterator()
    {
        return new Iterator($this->_items);
    }
}
