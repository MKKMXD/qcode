<?php 
namespace QCode\Elements;

final class MethodElement extends Element
{
    protected array $fields = [
        'name',
        'params',
        'returnType',
    ];

    protected array $values;

    protected string $viewName = "Method.md";
}