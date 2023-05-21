<?php

namespace QCode\Elements;

use QCode\Render\Render;

abstract class Element
{
    protected array $fields = [];

    protected array $values = [];

    protected string $viewName="";
    protected Render $render;

    public function __construct($data)
    {
        foreach ($this->fields as $field) {
            $this->values[$field] = "";
            if (isset($data[$field])) {
                $this->values[$field] = $data[$field];
            } 
        }
        $this->render = new Render();
    }

    public function render(): string
    {
        $file = file_get_contents(__DIR__ . "/Views/$this->viewName");

        if (!$file) {
            return "";
        }
        foreach ($this->values as $key => $value) {
            $this->render = new Render();
            if (is_array($value)) {
                $val = $this->render->render($value)
                    ->getText();
                $file = str_replace("{{$key}}", $val, $file);
            } else {
                $file = str_replace("{{$key}}", $value, $file);
            }
        }

        return $file;
    }
}