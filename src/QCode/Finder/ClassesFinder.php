<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\ClassDependencyElement;
use QCode\Elements\ClassElement;
use QCode\Elements\GroupClassElement;

final class ClassesFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Expr\New_::class;
    protected string $element = \QCode\Elements\GroupClassElement::class;

    protected function prepareNode(string $value)
    {
        return new ClassDependencyElement([$value]); 
    }

    public function prepareNodes(array $nodes): array
    {
        return [new GroupClassElement($nodes)]; 
    }
}