<?php

namespace QCode\Render;

final class Render extends AbstractRender
{
    private array $elements;
    private string $pageText = "";

    public function render($list): Render
    {
        foreach ($list as $element)
        {
            if (is_array($element)) {
                $this->render($element);
            } else {
                $this->pageText .= $element->render();
            }
        }

        return $this;
    }

    public function getText() {
        return $this->pageText;
    }
}