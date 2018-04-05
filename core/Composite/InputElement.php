<?php

namespace core\Composite;

class InputElement implements RenderableInterface
{
    public function render()
    {
        return '<input type="text" />';
    }
}
