<?php 

namespace QCode\Finder;

use QCode\Elements\GroupElement;
use QCode\Elements\PropertyElement;
use QCode\Elements\GroupPropertiesElement;

final class PropertiesFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\Property::class;

    public function prepareNode($value)
    {   
        $value = parent::prepareNode($value);
        $value = new PropertyElement($value);

        return $value;
    }

    public function prepareNodes(array $nodes): array
    {
        $nodes = new GroupElement([
            'title' => "Properties",
            'content' => $nodes]);
        return [$nodes];
    }
}