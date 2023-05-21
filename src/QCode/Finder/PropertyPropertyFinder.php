<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\PropertyElement;

final class PropertyPropertyFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\PropertyProperty::class;

    protected array $dependencies = [

    ];

    private array $types = [
        'array' => \PhpParser\Node\Expr\Array_::class,
        'string' => \PhpParser\Node\Scalar\String_::class,
        'int' => \PhpParser\Node\Scalar\LNumber::class,
        'float' => \PhpParser\Node\Scalar\DNumber::class,
    ];

    public function __construct($type)
    {
        parent::__construct();
        $this->nodeName = $this->types[$type];
    }

    public function collectNodes($elements, $findDepedencies = []): array
    {
        $list = [];
        foreach ($elements as $key => $element) {
            $list[] = $element->value;
        }

        return $list;
    }
}