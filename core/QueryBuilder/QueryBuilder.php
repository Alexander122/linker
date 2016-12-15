<?php

namespace core\QueryBuilder;

class QueryBuilder
{
    /**
     * Query
     *
     * @var
     */
    private $_query;
    
    public function __construct()
    {
        $this->_query = new Query();
    }
    
    public function __get($name)
    {
        $method = "get" . ucfirst($name);
        if (method_exists($this, $method))
            return $this->$method();
    }
    
    public function getQuery()
    {
        return $this->_query->query;
    }

    /**
     * @param string $condition
     * @return $this
     */
    public function select($condition = '*')
    {
        $list = self::getList($condition);
        $this->_query->addQuery("SELECT {$list}");

        return $this;
    }
    
    /**
     * @param $tableName
     * @return $this
     */
    public function from($tableName)
    {
        $this->_query->addQuery(" FROM {$tableName}");
        
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
        $this->_query->addQuery(" WHERE ");
        foreach ($condition as $key => $value) {
            if (is_array($value)) {
                $item = each($value);
                $this->_query->addQuery("`{$item['key']}` = '{$item['value']}'");
            } else {
                $this->_query->addQuery(" {$value} ");
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
        $this->_query->addQuery(" ORDER BY {$condition} {$order}");

        return $this;
    }

    /**
     * @param $condition
     * @return $this
     */
    public function groupBy($condition)
    {
        $this->_query->addQuery(" GROUP BY {$condition}");

        return $this;
    }

    /**
     * @return $this
     */
    public function insert()
    {
        $this->_query->addQuery("INSERT INTO {$this->tableName}");

        return $this;
    }

    /**
     * @param $condition
     * @return $this
     */
    public function columns($condition)
    {
        $list = self::getList($condition);
        $this->_query->addQuery(" ({$list})");

        return $this;
    }

    /**
     * @param $condition
     * @return bool|\mysqli_result
     */
    public function values($condition)
    {
        $list = self::getList($condition, true);
        $this->_query->addQuery(" VALUES ({$list})");

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
