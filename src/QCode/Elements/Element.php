<?php

namespace QCode\Elements;

use QCode\Render\Render;

abstract class Element
{
    protected array $fields = [];

    protected array $values= [];

    protected string $viewName="";

    protected Render $render;

    public function __construct(array $values)
    {
        $this->values = $values;
        $this->render = new Render();
    }

    public function render(): string
    {
        $content = file_get_contents(__DIR__ . "/Views/$this->viewName");

        if (!$content) {
            return "";
        }
        
        $string = "";
        foreach ($this->values as $value) {
            if (is_object($value)) $string .= $this->prepareElementRender($value->render());
            else $string .= $this->prepareElementRender($value);
        }

        $string = str_replace(array("{", "}", "\n"), "", $string);

        $content = str_replace("{content}", $string, $content);

        return $content;
    }

    protected function prepareElementRender(string $content)
    {
        return $content;
    }

    public function setValue(array $values)
    {
        $this->values = $values;

        return $this;
    }
}