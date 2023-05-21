<?php
namespace QCode\Finder;
use PhpParser\NodeFinder;

abstract class AbstractFinder implements IFinder
{
    protected string $nodeName = "";

    protected array $dependencies = [];
    
    protected array $findDepedencies = [];
    
    private NodeFinder $finder;

    public function __construct()
    {
        
    }

    public function getFinder(): NodeFinder
    {
        if (!isset($this->finder)) {
            $this->finder = new NodeFinder();
        }

        return $this->finder;
    }
    
    public function search($stmts, $groupLine = null): array
    {
        $newElements = [];
        if ($stmts) {
            $finder = $this->getFinder();
            $elements = $finder->findInstanceOf($stmts, $this->nodeName);
            $elements = $this->filter($elements, $groupLine);
            $findDepedencies = [];
            foreach ($elements as $key => &$element) {
                $line = $element->getLine();
                $newElements[$line] = $element;
                    
                if (!empty($this->dependencies)) {
                    $findDepedencies[$line] = [];
                    foreach ($this->dependencies as $keyDependency => $dependency) {
                        if (is_array($dependency)) {
                            $findDepedencies[$line][$keyDependency] = [];
                            foreach ($dependency as $keyElem => $elem) {
                                $findDepedencies[$line][$keyDependency][$keyElem] = $elem->search($stmts, $line);
                            }
                        } else {
                            $findDepedencies[$line][$keyDependency] = $dependency->search($stmts, $line);
                        }
                    }
                }
            }
        }

        $nodes = $this->collectNodes($newElements, $findDepedencies);

        return $nodes;
    }

    public function filter($elements, $groupLine)
    {
        if (is_null($groupLine)) return $elements;
        $elements = array_filter($elements, function($elem) use ($groupLine) {
            if ($elem->getLine() == $groupLine) return $elem;
        });

        return $elements;
    }

    public function collectNodes(array $elements, array $findDepedencies = []): array
    {
        return [];
    }
}