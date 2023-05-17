<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;

final class MethodsFinder extends AbstractFinder
{
    private string $nodeName = PhpParser\Node\Stmt\ClassMethod::class;

    public function collectNodes($elements): array
    {
        $list = [];

        foreach ($elements as $prop) {
            $className = implode("_", $prop->class->parts);
            $list[$className] = [
                "name" => $className,
            ];
        }

        return $list;
    }
}