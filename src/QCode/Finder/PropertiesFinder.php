<?php 

namespace QCode\Finder;

use QCode\Elements\PropertyElement;
use QCode\Elements\GroupPropertiesElement;

final class PropertiesFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\Property::class;

    protected string $element = \QCode\Elements\GroupElement::class;

    protected function prepareNode(string $value)
    {
        return new PropertyElement([$value]);
    }

    public function prepareNodes(array $nodes): array
    {
        return [new GroupPropertiesElement($nodes)]; 
    }
}