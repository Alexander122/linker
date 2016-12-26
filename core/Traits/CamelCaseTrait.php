<?php

namespace core\Traits;

trait CamelCaseTrait
{
    /**
     * Leads name camel-case to the form CamelCase
     *
     * @param $item
     * @return mixed
     */
    public static function parseCamelCase($item)
    {
        $piece = explode('-', $item);
        $piece = array_map(function ($value) {
            return ucfirst($value);
        }, $piece);
        $piece = implode('', $piece);
        
        return $piece;
    }
}
