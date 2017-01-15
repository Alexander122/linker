<?php
// TODO реализовать обьект, который будет перебирать, конвертировать и т.п. мыссивы

namespace core\Helpers;

class ArrayHelper
{
    /**
     * Converts an array of species ['id' => 1, 'name' => 'Alex'] to `id` = '1', `name` = 'Alex'
     *
     * @param $array
     * @return string
     */
    public static function convertArrayToString($array)
    {
        $result = '';
        for ($i = 0, $count = count($array); $i < $count; $i++) {
            $element = each($array);
            $result .= " {$element['key']} = {$element['value']}";
            if ($i != $count - 1) {
                $result .= ", ";
            }
        }

        return $result;
    }
}
