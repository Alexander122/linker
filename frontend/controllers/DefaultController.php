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
        $model = $model->getAllPosts();

        var_dump($model);
    }
}
