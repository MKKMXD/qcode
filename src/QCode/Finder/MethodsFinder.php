<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\MethodElement;
use QCode\Elements\GroupMethodsElement;

final class MethodsFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\ClassMethod::class;

    protected function prepareNode(string $value)
    {
        return new MethodElement([$value]); 
    }

    public function prepareNodes(array $nodes): array
    {
        return [new GroupMethodsElement($nodes)]; 
    }
}