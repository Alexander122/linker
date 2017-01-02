<?php

namespace frontend\controllers;

use frontend\models\PostsModel;
use core\QueryBuilder\QueryBuilder;
use core\QueryBuilder\Query;
use core\controllers\Controller;
use core\Manager\Manager;
use core\FluentInterface\FluentInterface;
use core\Social\VkApi;

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
        
        // var_dump(Config::core('main')['urlParser']);
        
        $query = (new FluentInterface())
            ->select('id')
            ->from('users');
        $model = (new PostsModel())->allQuery($query);
        // var_dump($model);
        
        session_start(); 
        if (!isset($_SESSION['counter'])) $_SESSION['counter']=0;
        echo "Вы обновили эту страницу ".$_SESSION['counter']++." раз.<br>
        <a href=".$_SERVER['REQUEST_URI'].">обновить</a>";
    }
    
    public function actionApi()
    {var_dump(10);die;
        $query = VkApi::send('users.search', [
            'sex' => 1,
            'status' => 6,
            'age_from' => 20,
            'age_to' => 24,
            'count' => 50,
            'city' => 650, // 650 - dnepr
            'fields' => 'city',
            'access_token' => Manager::config('core', 'main', 'social.vk.access_token'),
        ]);
        var_dump($query);
    }
}
