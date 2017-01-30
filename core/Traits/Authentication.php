<?php
// TODO реализовать методы аутентификации signup(), login(), logout() при помощи сессии или куков

namespace core\Traits;

use core\FluentInterface\FluentInterface;

// TODO сделать главный класс Linker и поместить в него регистрацию, роутинг
// TODO реализовать фронт контроллер (как в Magento)
trait Authentication
{
    // TODO полазить в yii2 и хорошенько посмотреть как там реализована аутентификация (можно вынести аутентификацию в отдельный модуль)
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
        if ($user->save()) {
            return true;
        }

        return false;
    }
    
    public function login($login, $password, $rememberMe = false)
    {
        if (isset($_COOKIE[$this->getAuthKeyField()])) {
            $query = (new FluentInterface())
            ->select()
            ->from($this->getTableName())
            ->where([[$this->getAuthKeyField() => $_COOKIE[$this->getAuthKeyField()]]]);
            $user = $this->selectOne($query);
            if ($user) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['user_' . $user->id] = $user;
                return true;
            }
        }

        $query = (new FluentInterface())
            ->select()
            ->from($this->getTableName())
            ->where([[$this->getLoginField() => $login]]);
        $user = $this->selectOne($query);
        if (!$user) {
            return false;
        }

        if ($this->checkPassword($password, $user->password)) {
            unset($_COOKIE[$this->getAuthKeyField()]);
            setcookie($this->getAuthKeyField(), $user->{$this->getAuthKeyField()}, $rememberMe ? time() + 60 * 60 * 24 * 30 : 0);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_' . $user->id] = $user;
            return true;
        }
        
        return false;
    }

    public function logout($login)
    {
        $query = (new FluentInterface())
            ->select()
            ->from($this->getTableName())
            ->where([[$this->getLoginField() => $login]]);
        if ($user = $this->selectOne($query)) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            unset($_SESSION['user_' . $user->id]);
            unset($_COOKIE[$this->getAuthKeyField()]);
            $sql = (new FluentInterface())
                ->insert($this->getTableName())
                ->columns([$this->getAuthKeyField()])
                ->values([$this->getAuthenticationKey()]);
            $user->save($sql);
            session_destroy();
            return true;
        }

        return false;
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
