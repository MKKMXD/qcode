<?php 
namespace QCode\Elements;

final class ParamsElement extends Element
{
    protected array $fields = [
        'name',
        'type',
        'default',
    ];

    protected array $values;

    protected string $viewName = "Params.md";
}