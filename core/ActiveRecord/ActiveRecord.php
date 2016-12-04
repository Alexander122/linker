<?php

namespace core\ActiveRecord;

class ActiveRecord extends BaseActiveRecord
{
    use QueryBuilder;

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
}
