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
     * Get ActiveRecord field
     * 
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name = $this->fields[$name];
    }

    /**
     * Set ActiveRecord field
     * 
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (isset($this->fields[$name])) {
            $this->fields[$name] = $value;
        }
    }
}
