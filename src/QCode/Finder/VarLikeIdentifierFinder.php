<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\PropertyElement;

final class VarLikeIdentifierFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\VarLikeIdentifier::class;

    protected array $dependencies = [];

    public function collectNodes($elements, $findDepedencies = []): array
    {
        $list = [];
        foreach ($elements as $key => $element) {
            $list[] = $element->name;
        }
        return $list;
    }
}