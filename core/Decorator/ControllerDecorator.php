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
        $this->component->{$action}();
        $this->component->afterAction();
    }
}
