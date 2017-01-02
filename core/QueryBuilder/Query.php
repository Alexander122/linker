<?php

namespace core\QueryBuilder;

class Query {

    private $_query;
    
    public function getQuery()
    {
        return $this->_query;
    }
    
    public function addQuery($query)
    {
        $this->_query .= $query;
    }
    
    public function __get($name)
    {
        $method = "get" . ucfirst($name);
        if (method_exists($this, $method))
            return $this->$method();
            
        return property_exists($this, $name) ? $this->$name : null;
    }
}
