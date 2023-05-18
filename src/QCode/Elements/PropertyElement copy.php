<?php 
namespace QCode\Elements;

final class PropertyElement extends Element
{
    protected array $fields = [
        'modifier',
        'type',
        'name',
    ];

    protected array $values;

    protected string $viewName = "Property.md";
}