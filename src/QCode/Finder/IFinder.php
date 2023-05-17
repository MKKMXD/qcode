<?php 

namespace QCode\Finder;

interface IFinder
{
    /**
     * @param PHPParser\Node|PHPParser\Node[] $stmts
     * @return array
     */
    public function search($stmts): array;

    public function collectNodes($elements): array;
}