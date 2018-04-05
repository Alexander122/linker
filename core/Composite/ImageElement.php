<?php

namespace core\Composite;

class ImageElement implements RenderableInterface
{
    private $src;

    public function __construct($src)
    {
        $this->src = $src;
    }

    public function getSrc()
    {
        return $this->src;
    }

    public function render()
    {
        $src = $this->getSrc();

        return sprintf('<img src="%s">', $src);
    }
}
