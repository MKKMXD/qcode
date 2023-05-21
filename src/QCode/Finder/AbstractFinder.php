<?php
namespace QCode\Finder;
use PhpParser\NodeFinder;
use PhpParser\PrettyPrinter\Standard;
use Qcode\Elements\Element;

abstract class AbstractFinder implements IFinder
{
    protected string $nodeName = "";
    
    private NodeFinder $finder;

    protected string $element;

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
    
    public function search($stmts): array
    {
        $nodes = [];
        if ($stmts) {
            $finder = $this->getFinder();
            $elements = $finder->findInstanceOf($stmts, $this->nodeName);
            $prettyPrinter = new Standard;
            foreach ($elements as $key => $element) {
                $newElement = clone $element;
                $newElement->stmts = [];
                $nodes[] = $this->prepareNode($prettyPrinter->prettyPrint([$newElement]));
            }
        }

        $nodes = $this->prepareNodes($nodes);

        return $nodes;
    }

    protected function prepareNode(string $value)
    {
        return $value;
    }

    public function prepareNodes(array $nodes): array
    {
        return $nodes;
    }
}