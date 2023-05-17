<?php
namespace QCode\Finder;
use PhpParser\NodeFinder;

abstract class AbstractFinder implements IFinder
{
    private string $nodeName = "";
    
    private NodeFinder $finder;

    public function getFinder(): NodeFinder
    {
        if (!$this->finder) {
            $this->finder = new NodeFinder();
        }

        return $this->finder;
    }
    
    public function search($stmts): array
    {
        $finder = $this->getFinder();

        $elements = $finder->findInstanceOf($stmts, $this->nodeName);
        $nodes = $this->collectNodes($elements);

        return $nodes;
    }

    public function collectNodes($elements): array
    {
        return [];
    }
}