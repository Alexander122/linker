<?php

namespace core\ActiveRecord;


use core\models\Model;

/**
 * Class BaseActiveRecord
 * @package core\ActiveRecord
 */
class BaseActiveRecord extends Model
{
    /**
     * ActiveRecord fields
     *
     * @var array
     */
    protected $fields = [];

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $method = "get" . ucfirst($name);
        if (method_exists($this, $method))
            return $this->$method();
        
        if (array_key_exists($name, $this->fields))
            $value = $this->fields[$name];
            
        return isset($value) ? $value : null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->fields)) {
            $this->fields[$name] = $value;
        }
    }
}
