<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;

final class ClassesFinder extends AbstractFinder
{
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