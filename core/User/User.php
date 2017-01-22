<?php
// TODO реализовать модель пользователя для методов аутентификации
namespace core\User;

use core\models\Model;
use core\Traits\Authentication;

class User extends Model implements AuthenticationInterface
{
    use Authentication;
    
    public function checkPassword($password, $hashPassword)
    {
        return $hashPassword === md5($password);
    }
}
