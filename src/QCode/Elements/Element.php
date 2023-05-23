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

        foreach ($this->values as $key => $value) {
            if (is_array($value)) {
                $this->values[$key] = $this->prepareElementRender($this->processingData($value, ""));
            } else if (is_object($value)) {
                $this->values[$key] = $this->prepareElementRender($value->render());
            } else {
                $this->values[$key] = $this->prepareElementRender($value);
            }
        }
        
        foreach ($this->values as $key => $value) {
            $string = str_replace(array("{", "}"), "", $value);
            $content = str_replace("{{$key}}", $string, $content);
        }

        return $content;
    }

    protected function processingData(array $elements, $content) 
    {
        foreach ($elements as $key => $value) {
            if (is_array($value)) {
                $content .= $this->processingData($value, $content);
            } else if (is_object($value)) {
                $content .= $this->prepareElementRender($value->render());
            } else {
                $content .= $this->prepareElementRender($value);
            }
        }

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