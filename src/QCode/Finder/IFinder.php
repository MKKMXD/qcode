<?php 

namespace QCode\Finder;
use QCode\Elements\Element;
interface IFinder
{
    /**
     * @param PHPParser\Node|PHPParser\Node[] $stmts
     * @return array
     */
    public function search($stmts): array;

    public function prepareNodes(array $elements): array;
}