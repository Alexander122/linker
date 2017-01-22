<?php
// TODO реализовать модель пользователя для методов аутентификации
namespace core\User;

use core\ActiveRecord\ActiveRecord;
use core\ActiveRecord\ActiveRecordInterface;
use core\Traits\Authentication;

class User extends ActiveRecord implements AuthenticationInterface, ActiveRecordInterface
{
    use Authentication;
    
    public function getLoginField()
    {
        return 'name';
    }

    public function getPasswordField()
    {
        return 'password';
    }

    public function getAuthKeyField()
    {
        return 'auth_key';
    }

    public function getTableName()
    {
        return 'users';
    }

    public function getPrimaryKey()
    {
        return 'user_id';
    }
}
