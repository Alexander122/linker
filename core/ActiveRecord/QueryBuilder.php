<?php

namespace core\ActiveRecord;

trait QueryBuilder
{
    /**
     * Table name
     *
     * @var
     */
    protected $tableName;

    /**
     * Query
     *
     * @var
     */
    private $_query;

    /**
     * @param string $condition
     * @return $this
     */
    public function select($condition = '*')
    {
        $list = self::getList($condition);
        $this->_query = "SELECT {$list} FROM {$this->tableName}";

        return $this;
    }

    /**
     * @param array $condition
     * @return $this
     */
    public function where($condition = [])
    {
        $this->_query .= ' WHERE ';
        foreach ($condition as $key => $value) {
            if (is_array($value)) {
                $item = each($value);
                $this->_query .= "`{$item['key']}` = '{$item['value']}'";
            } else {
                $this->_query .= " {$value} ";
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
        $this->_query .= " ORDER BY {$condition} {$order}";

        return $this;
    }

    /**
     * @param $condition
     * @return $this
     */
    public function groupBy($condition)
    {
        $this->_query .= " GROUP BY {$condition}";

        return $this;
    }

    /**
     * @return array
     */
    public function one()
    {
        return $this->recordFields($this->mysqli->query($this->_query)->fetch_assoc());
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->recordFields(self::getMySqlResultAsArray($this->mysqli->query($this->_query)));
    }

    /**
     * @return $this
     */
    public function insert()
    {
        $this->_query = "INSERT INTO {$this->tableName}";

        return $this;
    }

    /**
     * @param $condition
     * @return $this
     */
    public function columns($condition)
    {
        $list = self::getList($condition);
        $this->_query .= " ({$list})";

        return $this;
    }

    /**
     * @param $condition
     * @return bool|\mysqli_result
     */
    public function values($condition)
    {
        $list = self::getList($condition, true);
        $this->_query .= " VALUES ({$list})";

        return $this->mysqli->query($this->_query);
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

    /**
     * Convert the array to the list in the form of "'value one', 'value two'..."
     *
     * @param $condition
     * @param bool $quotes
     * @return array|string
     */
    public static function getList($condition, $quotes = false)
    {
        if (is_array($condition)) {
            $list = '';
            $comma = ', ';
            $quotes = $quotes ? "'" : "";
            foreach ($condition as $key => $value) {
                next($condition) ?: $comma = '';
                $list .= "{$quotes}{$value}{$quotes}{$comma}";
            }
        } else {
            return $condition;
        }

        return $list;
    }
}