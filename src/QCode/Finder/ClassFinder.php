<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\ClassNameElement;

final class ClassFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\Class_::class;
    protected string $element = \QCode\Elements\ClassNameElement::class;

    protected function prepareNode(string $value)
    {
        return new ClassNameElement([$value]);
    }
}