<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\PropertyElement;

final class NameFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Name::class;

    protected array $dependencies = [];

    public function collectNodes($elements, $findDepedencies = []): array
    {
        $list = [];
        foreach ($elements as $key => $element) {
            $list[] = implode("\\", $element->parts);
        }
        return $list;
    }
}