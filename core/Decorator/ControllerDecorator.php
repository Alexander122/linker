<?php

namespace core\Decorator;

class ControllerDecorator extends AbstractDecorator
{
    /**
     * Sequence controller methods
     */
    public function operations($action)
    {
        $this->component->beforeAction();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        call_user_func_array([$this->component, $action], [$id]);
        $this->component->afterAction();
    }
}
