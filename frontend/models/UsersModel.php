<?php

namespace frontend\models;

use core\ActiveRecord\ActiveRecord;
use core\ActiveRecord\ActiveRecordInterface;

/**
 * Class HelloWorld
 * @package frontend\models
 */
class UsersModel extends ActiveRecord implements ActiveRecordInterface
{
    public function getTableName()
    {
        return 'users';
    }
    
    public function getPrimaryKey()
    {
        return 'id';
    }

    /**
     * @return array
     */
    public function getAllPosts()
    {
        return $this->select()->one();
    }
}
