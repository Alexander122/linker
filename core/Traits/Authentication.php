<?php
// TODO реализовать методы аутентификации signup(), login(), logout() при помощи сессии или куков

namespace core\Traits;

use core\FluentInterface\FluentInterface;

trait Authentication
{
    public function signup($login, $password)
    {
        $query = (new FluentInterface())
            ->select()
            ->from($this->getTableName())
            ->where([[$this->getLoginField() => $login]]);
        $user = $this->selectOne($query);
        if ($user) {
            return false;
        }
        $user = new self();
        $user->{$this->getLoginField()} = $login;
        $user->{$this->getPasswordField()} = md5($password);
        $user->{$this->getAuthKeyField()} = $this->getAuthenticationKey();
        setcookie("authKey", $user->{$this->getAuthKeyField()});
        // TODO save() нечего не возвращает
        $user->save();

        return $user;
    }
    
    public function login($login, $password, $authKeyValidation = false)
    {
        $query = (new FluentInterface())
            ->select()
            ->from($this->getTableName())
            ->where([[$this->getLoginField() => $login]]);
        $user = $this->selectOne($query);
        if (!$user) {
            return false;
        }
        if ($authKeyValidation != false && !empty($authKeyValidation)) {
            if ($user->auth_key === $authKeyValidation) {
                session_start();
                $_SESSION['user'] = $user;
                return true;
            }
            
            return false;
        }
        if ($this->checkPassword($password, $user->password)) {
            session_start();
            $_SESSION['user'] = $user;
            return true;
        }
    }
    
    public function checkPassword($password, $hashPassword)
    {
        return $hashPassword === md5($password);
    }

    public function getAuthenticationKey($length = 32)
    {
        $arr = [
            'a', 'b', 'c', 'd', 'e', 'f',
            'g', 'h', 'i', 'j', 'k', 'l',
            'm', 'n', 'o', 'p', 'r', 's',
            't', 'u', 'v', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F',
            'G', 'H', 'I', 'J', 'K', 'L',
            'M', 'N', 'O', 'P', 'R', 'S',
            'T', 'U', 'V', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6',
            '7', '8', '9', '0'
        ];
        $string = "";
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, count($arr) - 1);
            $string .= $arr[$index];
        }

        return $string;
    }
}
