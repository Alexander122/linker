<?php

namespace core\ActiveRecord;

use core\FluentInterface\FluentInterface;

// TODO реализовать методы save(), load(), delete()
class ActiveRecord extends BaseActiveRecord
{
    public function fetch($query = '', $amount = false)
    {
        if ($amount == true) {
            $result = $this->mysqli->query($query)->fetch_assoc();
        } elseif ($amount == false) {
            $result = self::getMySqlResultAsArray($this->mysqli->query($query));
        }
            
        return $this->recordFields($result);
    }
    
    /**
     * @return array
     */
    public function selectOne($query)
    {
        return $this->recordFields($this->mysqli->query($query)->fetch_assoc());
    }

    /**
     * @return array
     */
    public function selectAll($query)
    {
        return $this->recordFields(self::getMySqlResultAsArray($this->mysqli->query($query)));
    }

    public function insert($query)
    {
        return $this->mysqli->query($query);
    }

    public function update($query)
    {
        return $this->mysqli->query($query);
    }

    /**
     * Returns query results in the form of ActiveRecord or array ActiveRecord`s
     *
     * @param $records
     * @return array|ActiveRecord
     */
    public function recordFields($records)
    {
        $result = [];
        foreach ($records as $key => $kit) {
            if (is_array($kit)) {
                $activeRecord = new $this;
                foreach ($kit as $field => $value) {
                    $activeRecord->fields[$field] = $value;
                }
                $result[] = $activeRecord;
            } else {
                $this->fields[$key] = $kit;
            }
        }

        return !empty($result) ? $result : $this;
    }
    
        /**
     * Get an array of records as an array
     *
     * @param $mysql_result
     * @return array
     */
    public static function getMySqlResultAsArray($mysql_result)
    {
        $result = [];
        while ($row = $mysql_result->fetch_assoc()) {
            $result[] = $row;
        }

        return $result;
    }
    
    public function beforeSave()
    {

    }
    
    final public function save()
    {
        $this->beforeSave();
        $query = new FluentInterface();
        $primaryKey = $this->{$this->getPrimaryKey()};
        if (!empty($primaryKey)) {
            $sql = $query
                ->update($this->getTableName())
                ->set($this->fields)
                ->where([[$this->getPrimaryKey() => $primaryKey]]);
            $this->update($sql);
        } else {
            $sql = $query
                ->insert($this->getTableName())
                ->columns(array_flip($this->fields))
                ->values($this->fields);
            $this->insert($sql);
        }
        $this->afterSave();
    }
    
    public function afterSave()
    {
        
    }
}
