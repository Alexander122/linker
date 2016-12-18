<?php

namespace frontend\controllers;

use frontend\models\PostsModel;
use core\QueryBuilder\QueryBuilder;
use core\QueryBuilder\Query;
use core\controllers\Controller;
use core\Manager\Config;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    public static function actionIndex($id)
    {
        $builder = new QueryBuilder();
        $builder
            ->select('id')
            ->from('users')
            ->where([['id' => 1], 'and', ['name' => 'mark']]);
        
        $model = new PostsModel();
        $model = $model->allQuery($builder->query);
        
        $array = [
            'option1' => 'value1', 
            'option2' => 'value2', 
            'array1' => [
                'sub_option1' => 'value3', 
                'sub_option2' => 'value4'
            ]
        ];
        $object = (object) $array;
        $stdClass = (object) [
            'propertyOne' => 'foo',
            'propertyTwo' => 42,
        ];
        
        $obj = new StdObject();
        $obj->name = "Nick";
        $test = '111';
        $stdO = 'ducks';
        $obj->func = function() {
            return 111;
        };
        call_user_func_array([$obj, 'test'], ['YES 1 !!!', 'YES 2 !!!']);
        
        var_dump($id);
    }
    
    public function actionConfig()
    {
        // $config = new Config();
        // $config->name = 'mark';
        // $config->age = 20;
        // $config->array = [
        //     'hello' => 11
        // ];
        // $config->obj = new \stdClass();
        // $config->obj->name = 'jack';
        
        // $config = new Config();
        // var_dump($config);
        // var_dump(clone $config);
        // var_dump(new Config());
        // var_dump(new \stdClass());
        // var_dump(new PostsModel());
        
        var_dump(Config::core('main'));
    }
}
