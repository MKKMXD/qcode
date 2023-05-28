<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\GroupElement;
use QCode\Elements\MethodElement;
use QCode\Elements\GroupMethodsElement;

final class MethodsFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\ClassMethod::class;

    public function prepareNode($value)
    {   
        $value = parent::prepareNode($value);
        $value['content'] = str_replace(array("{", "}", "\n"), "", $value['content']);
        $value = new MethodElement($value);

        return $value;
    }

    public function prepareNodes(array $nodes): array
    {

        $nodes = new GroupElement([
            'title' => "Methods of class",
            'content' => $nodes]);
        return [$nodes];
    }
}