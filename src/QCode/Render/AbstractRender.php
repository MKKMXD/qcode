<?php
namespace QCode\Render;

abstract class AbstractRender implements IRender
{
    public function render($list): Render
    {
        return $this;
    }
}