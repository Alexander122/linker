<?php

namespace frontend\models;

use core\ActiveRecord\ActiveRecord;

/**
 * Class HelloWorld
 * @package frontend\models
 */
class PostsModel extends ActiveRecord
{
    /**
     * @var string
     */
    public $tableName = 'posts';

    /**
     * @return array
     */
    public function getAllPosts()
    {
        return $this->select()->one();
    }
}
