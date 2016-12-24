<?php

namespace core\ActiveRecord;

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
    public function oneQuery($query)
    {
        return $this->recordFields($this->mysqli->query($query)->fetch_assoc());
    }

    /**
     * @return array
     */
    public function allQuery($query)
    {
        return $this->recordFields(self::getMySqlResultAsArray($this->mysqli->query($query)));
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
}
