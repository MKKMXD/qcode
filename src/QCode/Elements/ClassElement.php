<?php 
namespace QCode\Elements;

final class ClassElement extends Element
{
    protected array $fields = [
        'name',
    ];

    protected array $values;

    protected string $viewName = "Class.md";
}