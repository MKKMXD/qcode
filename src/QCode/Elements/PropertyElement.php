<?php 
namespace QCode\Elements;

final class PropertyElement extends Element
{
    protected array $fields = [
        'name',
        'default',
        'type',
        'modifier',
    ];

    protected array $values;

    protected string $viewName = "Property.md";
}