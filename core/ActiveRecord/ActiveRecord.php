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
     * @param $query
     * @return array|bool|ActiveRecord
     */
    public function selectOne($query)
    {
        if (empty($query)) {
            return null;
        }
        if (!$request = $this->mysqli->query($query)) {
            return null;
        }
        if (!$fetchAssoc = $request->fetch_assoc()) {
            return null;
        }

        return $this->recordFields($fetchAssoc);
    }

    /**
     * @param $query
     * @return array|bool|ActiveRecord
     */
    public function selectAll($query)
    {
        if (empty($query)) {
            return null;
        }
        $request = $this->mysqli->query($query);
        if (!$request) {
            return null;
        }
        return $this->recordFields(self::getMySqlResultAsArray($request));
    }

    public function insertOne($query)
    {
        return $this->mysqli->query($query);
    }

    public function updateOne($query)
    {
        return $this->mysqli->query($query);
    }
    
    /**
     * Returns query results in the form of ActiveRecord or array ActiveRecord`s
     *
     * @param $records
     * @return array|ActiveRecord
     */
    protected function recordFields($records)
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
    protected static function getMySqlResultAsArray($mysql_result)
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
            // TODO реализовать update() и set()
            $sql = $query
                ->update($this->getTableName())
                ->set($this->fields)
                ->where([[$this->getPrimaryKey() => $primaryKey]]);
            $this->updateOne($sql);
        } else {
            $sql = $query
                ->insert($this->getTableName())
                ->columns(array_keys($this->fields))
                ->values(array_values($this->fields));
            $this->insertOne($sql);
        }
        $this->afterSave();
    }

    public function afterSave()
    {

    }
}
