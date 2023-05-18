<?php 

namespace QCode\Finder;

use PhpParser\NodeFinder;
use QCode\Elements\MethodElement;
use QCode\Elements\ParamsElement;

final class MethodsFinder extends AbstractFinder
{
    protected string $nodeName = \PhpParser\Node\Stmt\ClassMethod::class;

    public function collectNodes($elements): array
    {
        $list = [];

        foreach ($elements as $method) {
            $returnType = "";
            if (!is_null($method->returnType)) {
                $returnType = isset($method->returnType->name) ? : "";
            }
    
            $list[$method->name->name] = new MethodElement([
                'name' => $method->name->name,
                'params' => $this->collectParams($method->params),
                'returnType' => $returnType,
            ]);
        }

        return $list;
    }

    public function collectParams($params) {
        $list = [];
        foreach ($params as $param) {
            $type = "";
            $default = "";
            if (!empty($param->type) && !empty($param->type->parts)) {
                $type = implode("_", $param->type->parts);
            }
            if (!empty($param->default)) {
                $default = implode("_", $param->default->name->parts);
            }
            
            $elem = [
                'name' => $param->var->name,
                'type' => $type,
                'default' => $default,
            ];
    
            $list[] = new ParamsElement($elem); 
        }
    
        return $list;
    }
}