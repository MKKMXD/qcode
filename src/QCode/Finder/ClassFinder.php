<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\ClassNameElement;
use QCode\Elements\CommitsElement;

final class ClassFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\Class_::class;
    protected string $element = \QCode\Elements\ClassNameElement::class;

    protected function prepareNode($value)
    {
        $value = parent::prepareNode($value);
        $value['commits'] = new CommitsElement(['content' => 'commit']);
        return new ClassNameElement($value);
    }
}