<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;

final class PropertiesFinder extends AbstractFinder
{
    private string $nodeName = PhpParser\Node\Expr\PropertyFetch::class;

    public function collectNodes($elements): array
    {
        $list = [];

        foreach ($elements as $prop) {
            if ($prop->var->name == "this")
            $list[$prop->name->name] = [
                'modifier' => "public",
                'type' => 'mixed',
                'name' => $prop->name->name,
            ];
        }

        return $list;
    }
}