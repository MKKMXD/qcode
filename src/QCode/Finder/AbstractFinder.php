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

    protected string $pathFile;

    public function __construct()
    {
        $this->pathFile = "";
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
            
            foreach ($elements as $key => $element) {
                $newElement = clone $element;
                $nodes[] = $this->prepareNode($newElement);
            }
        }

        $nodes = $this->prepareNodes($nodes);

        return $nodes;
    }

    protected function prepareNode($value)
    {
        $value->stmts = [];
        $comment = $value->getDocComment();
        $value->setDocComment(new \PhpParser\Comment\Doc(""));
        $prettyPrinter = new Standard;
        
        return [
            'comment' => $comment->getText(),
            'content' => $prettyPrinter->prettyPrint([$value]),
        ];
    }

    public function prepareNodes(array $nodes): array
    {
        return $nodes;
    }

    public function setPathFile(string $path)
    {
        $this->pathFile = $path;
    }
}