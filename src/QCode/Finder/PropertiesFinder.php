<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\PropertyElement;

final class PropertiesFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\Property::class;

    public function __construct()
    {
        parent::__construct();
        
        $this->dependencies['default'] = [
            "array" => new PropertyPropertyFinder("array"),
            "string" => new PropertyPropertyFinder("string"),
            "float" => new PropertyPropertyFinder("float"),
            "int" => new PropertyPropertyFinder("string"),
        ];
        $this->dependencies['name'] = new VarLikeIdentifierFinder();
        $this->dependencies['type'] = [
            'nameType' => new NameFinder(),
            //'identifierType' => new IdentifierFinder(),
        ];
    }

    public function collectNodes($elements, $findDepedencies = []): array
    {
        $list = [];
        foreach ($elements as $key => $element) {
            $default = "null";
            foreach ($findDepedencies[$key]['default'] as $value) {
                if (!empty($value)) {
                    $default = $value;
                }
            }

            $type = "";
            foreach ($findDepedencies[$key]['type'] as $value) {
                if (!empty($value)) {
                    $type = $value;
                }
            }

            $modifier = "public";
            if ($element->isProtected()) $modifier = "protected";
            if ($element->isPrivate()) $modifier = "private";

            $list[] = new PropertyElement([
                'modifier' => $modifier,
                'default' => $default,
                'type' =>  $type,
                'name' => $findDepedencies[$key]['name'],
            ]);
        }

        return $list;
    }
}