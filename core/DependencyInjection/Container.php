<?php

namespace core\DependencyInjection;

class Container
{
    private $_definitions = [];

    public function __construct($config)
    {

        var_dump($config);die;
    }
}
