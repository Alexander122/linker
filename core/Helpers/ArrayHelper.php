<?php

namespace core\Helpers;

/**
 * Class ArrayHelper
 * @package core\Helpers
 */
class ArrayHelper
{
    const EMPTY_STRING = '';

    /**
     * For example, converts an array type ['key one' => 'value one', 'key two' => 'value two', ...]
     * in a string like `key one` = 'value one', `key two` => 'value two', ...
     *
     * @param array $array
     * @param string $separator
     * @param string $fieldQuotes
     * @param string $valueQuotes
     * @return string
     */
    public static function getArrayAsFieldValue(array $array, $separator = ",", $fieldQuotes = "`", $valueQuotes = "'")
    {
        if (!is_array($array) || empty($array)) {
            return self::EMPTY_STRING;
        }

        $result = '';
        foreach ($array as $key => $value) {
            next($array) ?: $separator = '';
            $result .= "{$fieldQuotes}{$key}{$fieldQuotes} = {$valueQuotes}{$value}{$valueQuotes}{$separator}";
        }

        return $result;
    }

    /**
     * For example, converts an array type ['key one' => 'value one', 'key two' => 'value two', ...]
     * in a string like `value one`, `value two`, ...
     *
     * @param $array
     * @param string $separator
     * @param string $valueQuotes
     * @return string
     */
    public static function getArrayAsList($array, $separator = ",", $valueQuotes = "`")
    {
        if (!is_array($array) || empty($array)) {
            return self::EMPTY_STRING;
        }

        $list = '';
        foreach ($array as $key => $value) {
            next($array) ?: $separator = '';
            $list .= "{$valueQuotes}{$value}{$valueQuotes}{$separator}";
        }

        return $list;
    }
}
