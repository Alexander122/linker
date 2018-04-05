<?php

namespace core\Composite;

class Form implements RenderableInterface
{
    private $elements;

    public function __construct()
    {
        $this->elements = array();
    }

    public function addRenderElement(RenderableInterface $element)
    {
        $this->elements[] = $element;
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function render()
    {
        $formContent = '';
        foreach ($this->getElements() as $_element) {
            $formContent .= $_element->render();
        }

        return sprintf('<form>%s</form>', $formContent);
    }
}
