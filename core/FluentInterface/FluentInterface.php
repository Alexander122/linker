<?php

namespace core\FluentInterface;

class FluentInterface
{
    /**
     * Query
     *
     * @var
     */
    private $_query;
    
    public function addQuery($query)
    {
        $this->_query .= $query;
    }
    
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
        $list = self::getList($condition);
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
                $this->addQuery("`{$item['key']}` = '{$item['value']}'");
            } else {
                $this->addQuery(" {$value} ");
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
    public function columns($condition)
    {
        $list = self::getList($condition);
        $this->addQuery(" ({$list})");

        return $this;
    }

    /**
     * @param $condition
     * @return bool|\mysqli_result
     */
    public function values($condition)
    {
        $list = self::getList($condition, true);
        $this->addQuery(" VALUES ({$list})");

        return $this;
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
