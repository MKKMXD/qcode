<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\ClassDependencyElement;
use QCode\Elements\ClassElement;
use QCode\Elements\GroupClassElement;
use QCode\Elements\GroupElement;

final class ClassesFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Expr\New_::class;

    public function prepareNode($value)
    {   
        $value = parent::prepareNode($value);
        $value = new ClassDependencyElement($value);

        return $value;
    }

    public function prepareNodes(array $nodes): array
    {
        $nodes = new GroupElement([
            'title' => "Dependency classes",
            'content' => $nodes]);
        return [$nodes];
    }
}