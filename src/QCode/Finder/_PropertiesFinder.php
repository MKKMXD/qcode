<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\PropertyElement;

final class PropertiesFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Expr\PropertyFetch::class;

    public function collectNodes($elements): array
    {
        $list = [];

        foreach ($elements as $prop) {
            if ($prop->var->name == "this")
            $list[$prop->name->name] = new PropertyElement([
                'modifier' => "public",
                'type' => 'mixed',
                'name' => $prop->name->name,
            ]);
        }

        return $list;
    }
}