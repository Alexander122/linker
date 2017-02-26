<?php

namespace core\FluentInterface;

use core\Helpers\ArrayHelper;

class FluentInterface
{
    /**
     * Request to be formed
     *
     * @var
     */
    private $_query;

    /**
     * Add part of the request
     *
     * @param $query
     */
    public function addQuery($query)
    {
        $this->_query .= $query;
    }

    /**
     * Provide an object as a crafted request
     *
     * @return mixed
     */
    public function __toString()
    {
        return $this->_query;
    }

    /**
     * @param string $condition
     * @return $this
     */
    public function select($condition = '*')
    {
        $list = !is_array($condition) ? $condition : ArrayHelper::getArrayAsList($condition, ",", "");
        $this->addQuery("SELECT {$list}");

        return $this;
    }

    /**
     * @param $tableName
     * @return $this
     */
    public function from($tableName)
    {
        $this->addQuery(" FROM {$tableName}");

        return $this;
    }

    /**
     * This condition should be written as [['field one' => 'value one'], 'and', ['field two' => 'value two']... ]
     * For example: ->where([['id' => 1], 'and', ['name' => 'Alex']])
     *
     * @param array $condition
     * @return $this
     */
    public function where($condition = [])
    {
        $this->addQuery(" WHERE ");
        foreach ($condition as $key => $value) {
            if (is_array($value)) {
                $item = each($value);
                $equality = ArrayHelper::getArrayAsFieldValue([
                    $item['key'] => $item['value']
                ]);
                $this->addQuery($equality);
            } else {
                $this->addQuery(" " . mb_strtoupper($value) . " ");
            }
        }

        return $this;
    }

    /**
     * @param $condition
     * @param string $order
     * @return $this
     */
    public function orderBy($condition, $order = 'ASC')
    {
        $this->addQuery(" ORDER BY {$condition} {$order}");

        return $this;
    }

    /**
     * @param $condition
     * @return $this
     */
    public function groupBy($condition)
    {
        $this->addQuery(" GROUP BY {$condition}");

        return $this;
    }

    /**
     * @return $this
     */
    public function insert($tableName)
    {
        $this->addQuery("INSERT INTO {$tableName}");

        return $this;
    }

    /**
     * @param $condition
     * @return $this
     */
    public function columns(array $condition)
    {
        $list = ArrayHelper::getArrayAsList($condition, ",", "");
        $this->addQuery(" ({$list})");

        return $this;
    }

    /**
     * @param array $condition
     * @return $this
     */
    public function values(array $condition)
    {
        $list = ArrayHelper::getArrayAsList($condition, ",", "'");
        $this->addQuery(" VALUES ({$list})");

        return $this;
    }

    /**
     * @param $tableName
     * @return $this
     */
    public function update($tableName)
    {
        $this->addQuery("UPDATE {$tableName}");

        return $this;
    }

    /**
     * @param array $condition
     * @return $this
     */
    public function set(array $condition)
    {
        $list = ArrayHelper::getArrayAsFieldValue($condition);
        $this->addQuery(" SET {$list}");

        return $this;
    }

    /**
     * @return $this
     */
    public function delete()
    {
        $this->addQuery("DELETE ");

        return $this;
    }
}
