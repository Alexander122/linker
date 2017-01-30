<?php

namespace core\ActiveRecord;

use core\FluentInterface\FluentInterface;

class ActiveRecord extends BaseActiveRecord
{
    /**
     * @param $query
     * @return array|bool|ActiveRecord
     */
    public function selectOne($query)
    {
        if (empty($query)) {
            return false;
        }

        $request = $this->mysqli->query($query);
        if (!($request instanceof \mysqli_result)) {
            return false;
        }

        $fetchAssoc = $request->fetch_assoc();
        if (!is_array($fetchAssoc)) {
            return false;
        }

        return $this->getMySqlResultAsActiveRecord($fetchAssoc);
    }

    /**
     * @param $query
     * @return array|bool|ActiveRecord
     */
    public function selectAll($query)
    {
        if (empty($query)) {
            return false;
        }

        $request = $this->mysqli->query($query);
        if (!($request instanceof \mysqli_result)) {
            return false;
        }

        $mySqlResultArray = self::getMySqlResultAsArray($request);
        if (!is_array($mySqlResultArray)) {
            return false;
        }

        return $this->getMySqlResultAsActiveRecord($mySqlResultArray);
    }

    public function insertOne($query)
    {
        if (empty($query)) {
            return null;
        }

        return $this->mysqli->query($query);
    }

    /**
     * @param $query
     * @return bool|\mysqli_result
     */
    public function updateOne($query)
    {
        if (empty($query)) {
            return null;
        }

        return $this->mysqli->query($query);
    }
    
    /**
     * Returns query results in the form of ActiveRecord or array ActiveRecord`s
     *
     * @param $records
     * @return array|ActiveRecord
     */
    protected function getMySqlResultAsActiveRecord($records)
    {
        $result = [];
        $singleModel = new $this;
        foreach ($records as $key => $kit) {
            if (is_array($kit)) {
                $model = new $this;
                foreach ($kit as $field => $value) {
                    $model->{$field} = $value;
                }
                $result[] = $model;
                continue;
            }

            $singleModel->{$key} = $kit;
        }

        return !empty($result) ? $result : $singleModel;
    }

    /**
     * Get an array of records as an array
     *
     * @param $mysql_result
     * @return array|bool
     */
    protected static function getMySqlResultAsArray($mysql_result)
    {
        if (!($mysql_result instanceof \mysqli_result)) {
            return false;
        }

        $result = [];
        while ($row = $mysql_result->fetch_assoc()) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * Running before saving model
     *
     * @return bool
     */
    public function beforeSave()
    {
        return true;
    }

    /**
     * Saves or updates the data in the model
     *
     * @return bool
     */
    final public function save()
    {
        if (!$this->beforeSave()) {
            return false;
        }

        $query = new FluentInterface();
        $primaryKey = $this->{$this->getPrimaryKey()};
        $fields = $this->getAllFields();
        if (!empty($primaryKey)) {
            unset($fields[$this->getPrimaryKey()]);
            $sql = $query
                ->update($this->getTableName())
                ->set($fields)
                ->where([[$this->getPrimaryKey() => $primaryKey]]);
            $result = $this->updateOne($sql);
        } else {
            $sql = $query
                ->insert($this->getTableName())
                ->columns(array_keys($fields))
                ->values(array_values($fields));
            $result = $this->insertOne($sql);
        }

        return $result == true ? $this->beforeSave() : false;
    }

    /**
     * Running after saving model
     *
     * @return bool
     */
    public function afterSave()
    {
        return true;
    }


}
