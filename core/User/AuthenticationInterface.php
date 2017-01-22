<?php
// TODO 1. Поработать с сессией 2. Реализовать интерфейс аутентификации 3. Реализовать модель пользователя для аутентификации 4. Реализовать паттерн Наблюдатель (для AccessControl - Контроль доступа) в контроллере

namespace core\User;

interface AuthenticationInterface
{
    public function getLoginField();

    public function getPasswordField();

    public function getAuthKeyField();
}
