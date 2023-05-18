<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\ClassElement;

final class ClassesFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Expr\New_::class;

    public function collectNodes($elements): array
    {
        $list = [];
        foreach ($elements as $prop) {
            $className = implode("_", $prop->class->parts);
            $list[$className] = new ClassElement([
                "name" => $className,
            ]);
        }
        return $list;
    }
}