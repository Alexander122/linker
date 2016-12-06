<?php

namespace frontend\controllers;
use frontend\models\PostsModel;

/**
 * Class DefaultController
 */
class DefaultController
{
    public static function actionIndex()
    {
        $model = new PostsModel();
        $model = $model->select()->where([['id' => 15]])->one();

        var_dump($model);
    }
}
