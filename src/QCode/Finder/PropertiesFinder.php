<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\PropertyElement;

final class PropertiesFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\Property::class;

    public function collectNodes($elements): array
    {
        $list = [];

        foreach ($elements as $prop) {
            //if ($prop->var->name == "this")
            $list[$prop->props[0]->name->name] = new PropertyElement([
                'modifier' => 'public',
                'default' => "null",
                'type' =>  $prop->type->name,
                'name' => $prop->props[0]->name->name,
            ]);
        }

        return $list;
    }
}