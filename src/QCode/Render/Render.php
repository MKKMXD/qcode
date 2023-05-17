<?php

namespace QCode\Render;

final class Render extends AbstractRender
{
    private array $elements;

    public function render(): void
    {
        $text = "";
        foreach ($this->elements as $element)
        {
            $text .= $element->render();
        }
    }

    public function addElement(IRender $element): void 
    {
        $this->elements[] = $element;
    }
}