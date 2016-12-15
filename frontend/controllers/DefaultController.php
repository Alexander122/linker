<?php

namespace frontend\controllers;

use frontend\models\PostsModel;
use core\QueryBuilder\QueryBuilder;
use core\QueryBuilder\Query;
use core\controllers\Controller;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    public static function actionIndex()
    {
        $builder = new QueryBuilder();
        $builder
            ->select('id')
            ->from('users')
            ->where([['id' => 1], 'and', ['name' => 'mark']]);
        
        $model = new PostsModel();
        $model = $model->allQuery($builder->query);var_dump($model);
    }
}
